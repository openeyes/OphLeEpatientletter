<?php

/**
 * OpenEyes.
 *
 * Phase 1 of retiring the legacy OphLeEpatientletter module: convert every
 * "Epatient letter" event into an OphCoCorrespondence ("Correspondence") event.
 *
 * Approach (agreed with product):
 *  - Re-use the existing event: re-point its event_type to Correspondence and
 *    add a new et_ophcocorrespondence_letter row built from the legacy element.
 *  - The letters are created FINALISED: draft = 0, and no document delivery
 *    chain is created (the delivery chain is what carries PENDING status, so
 *    omitting it leaves nothing pending).
 *  - The legacy element tables are archived by renaming to archive_<table>
 *    rather than dropped, so the raw data remains recoverable.
 *
 * All lookups (event types, letter type) are resolved by class_name / name via
 * SQL sub-queries - IDs of lookup data are NOT assumed to be the same between
 * environments. This migration is intentionally pure SQL and does not touch any
 * Yii model.
 *
 * Field mapping (legacy -> correspondence letter):
 *   letter_html      -> body
 *   recipient_html   -> address
 *   event.event_date -> date
 *   epatient_printed -> print
 *   epatient_cc_gp=1 -> cc (text note only; the historic GP/address is unknown)
 *   created/modified user & date are copied across for fidelity.
 *   epatient_id, epatient_hosnum, importinfo are dropped (no correspondence home).
 *   introduction / re / footer / site_id are left NULL: the legacy blob has no
 *   structured equivalents, and letter_type defaults to "Other letter".
 */
class m260717_120000_convert_epatientletter_to_correspondence extends \OEMigration
{
    private const LEGACY_EVENT_TYPE_CLASS = 'OphLeEpatientletter';
    private const TARGET_EVENT_TYPE_CLASS = 'OphCoCorrespondence';
    private const DEFAULT_LETTER_TYPE_NAME = 'Other letter';
    private const CC_GP_NOTE = 'GP (historic recipient details unavailable)';

    private const LEGACY_TABLE = 'et_ophleepatientletter_epatientletter';
    private const LEGACY_VERSION_TABLE = 'et_ophleepatientletter_epatientletter_version';

    public function up()
    {
        // 1. Create a finalised Correspondence letter element for each legacy letter.
        //    Only convert events that are currently of the legacy type and do not
        //    already have a correspondence letter (guards against a partial re-run).
        $this->execute("
            INSERT INTO et_ophcocorrespondence_letter
                (event_id, date, address, body, cc, re, draft, print,
                 letter_type_id, created_user_id, created_date,
                 last_modified_user_id, last_modified_date, footer)
            SELECT
                el.event_id,
                e.event_date,
                el.recipient_html,
                el.letter_html,
                CASE WHEN el.epatient_cc_gp = 1 THEN '" . self::CC_GP_NOTE . "' ELSE NULL END,
                'CONVERTED FROM LEGACY E-PATIENT LETTER',
                0,
                el.epatient_printed,
                (SELECT id FROM ophcocorrespondence_letter_type
                    WHERE name = '" . self::DEFAULT_LETTER_TYPE_NAME . "' LIMIT 1),
                el.created_user_id,
                el.created_date,
                el.last_modified_user_id,
                el.last_modified_date,
                '' AS footer
            FROM " . self::LEGACY_TABLE . " el
            JOIN event e
                ON e.id = el.event_id
               AND e.event_type_id = (SELECT id FROM event_type
                    WHERE class_name = '" . self::LEGACY_EVENT_TYPE_CLASS . "' LIMIT 1)
            WHERE NOT EXISTS (
                SELECT 1 FROM et_ophcocorrespondence_letter l WHERE l.event_id = el.event_id
            )
        ");

        // 2. Re-point the events themselves onto the Correspondence event type.
        //    A finalised correspondence event has an empty info string.
        $this->execute("
            UPDATE event
            SET event_type_id = (SELECT id FROM event_type
                    WHERE class_name = '" . self::TARGET_EVENT_TYPE_CLASS . "' LIMIT 1),
                info = ''
            WHERE event_type_id = (SELECT id FROM event_type
                    WHERE class_name = '" . self::LEGACY_EVENT_TYPE_CLASS . "' LIMIT 1)
              AND id IN (SELECT event_id FROM " . self::LEGACY_TABLE . ")
        ");

        // 3. Add a note to the event info field to indicate that this event was converted from a legacy letter.
        $this->execute("
            UPDATE event
            SET info = CONCAT(info, 'Converted from legacy E-patient letter')
            WHERE event_type_id = (SELECT id FROM event_type
                    WHERE class_name = '" . self::TARGET_EVENT_TYPE_CLASS . "' LIMIT 1)
              AND id IN (SELECT event_id FROM " . self::LEGACY_TABLE . ")
        ");

        // 4. Archive the now-migrated legacy element tables (rename, don't drop).
        $this->execute("
            RENAME TABLE
                " . self::LEGACY_TABLE . " TO archive_" . self::LEGACY_TABLE . ",
                " . self::LEGACY_VERSION_TABLE . " TO archive_" . self::LEGACY_VERSION_TABLE . "
        ");

        return true;
    }

    public function down()
    {
        // 1. Restore the archived legacy tables so we can identify the migrated events.
        $this->execute("
            RENAME TABLE
                archive_" . self::LEGACY_TABLE . " TO " . self::LEGACY_TABLE . ",
                archive_" . self::LEGACY_VERSION_TABLE . " TO " . self::LEGACY_VERSION_TABLE . "
        ");

        // 2. Remove the correspondence letters that this migration created.
        $this->execute("
            DELETE FROM et_ophcocorrespondence_letter
            WHERE event_id IN (SELECT event_id FROM " . self::LEGACY_TABLE . ")
        ");

        // 3. Re-point the events back onto the legacy event type.
        $this->execute("
            UPDATE event
            SET event_type_id = (SELECT id FROM event_type
                    WHERE class_name = '" . self::LEGACY_EVENT_TYPE_CLASS . "' LIMIT 1),
                info = NULL
            WHERE event_type_id = (SELECT id FROM event_type
                    WHERE class_name = '" . self::TARGET_EVENT_TYPE_CLASS . "' LIMIT 1)
              AND id IN (SELECT event_id FROM " . self::LEGACY_TABLE . ")
        ");

        return true;
    }
}
