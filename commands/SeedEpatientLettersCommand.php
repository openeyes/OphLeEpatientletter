<?php
/**
 * OpenEyes
 *
 * (C) OpenEyes Foundation, 2026
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU Affero General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Affero General Public License for more details.
 * You should have received a copy of the GNU Affero General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2026, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/agpl-3.0.html The GNU Affero General Public License V3.0
 */

use Event;

/**
 * Seeds a number of "Epatient letter" events/letters against existing patients.
 *
 * Each selected patient receives 10% of the total requested count (so 100 letters
 * are spread across 10 patients, 10 letters each). Existing patients from the
 * database are used.
 */
class SeedEpatientLettersCommand extends CConsoleCommand
{
    private const EVENT_TYPE_NAME = 'Epatient letter';

    public function getHelp()
    {
        return <<<HELP

        Seeds "Epatient letter" events for existing patients.

        Usage:
        ./yiic seedepatientletters [count]

        Arguments:
        count   Total number of letters to create (default: 100).
                Each patient receives 10% of this total.

        Examples:
        ./yiic seedepatientletters          # 100 letters across 10 patients
        ./yiic seedepatientletters 50       # 50 letters (5 per patient) across 10 patients

        HELP;
    }

    /**
     * @param array $args positional arguments; $args[0] = total letter count.
     */
    public function run($args)
    {
        $count = isset($args[0]) ? (int)$args[0] : 100;

        if ($count < 1) {
            echo "count must be a positive integer\n";
            return 1;
        }

        // 10% of the total per patient => 10 patients regardless of count.
        $per_patient = max(1, (int)floor($count / 10));
        $num_patients = (int)ceil($count / $per_patient);

        $patients = $this->pickPatients($num_patients);
        if (count($patients) === 0) {
            echo "No patients found in the database to seed against.\n";
            return 1;
        }

        // epatient_id is NOT NULL and UNIQUE on the table, so allocate ids above
        // whatever legacy/seeded rows already exist.
        $next_epatient_id = (int)Yii::app()->db->createCommand()
            ->select('COALESCE(MAX(epatient_id), 0) + 1')
            ->from('et_ophleepatientletter_epatientletter')
            ->queryScalar();

        $created = 0;
        $used_patient_ids = array();

        echo "Seeding {$count} letter(s): {$per_patient} per patient across " . count($patients) . " patient(s)...\n";

        foreach ($patients as $patient) {
            if ($created >= $count) {
                break;
            }

            for ($i = 0; $i < $per_patient && $created < $count; $i++) {
                $this->createLetter($patient, $next_epatient_id++);
                $created++;
            }

            $used_patient_ids[] = $patient->id;
            echo "  patient {$patient->id}: letters seeded (running total {$created})\n";
        }

        echo "\nDone. Created {$created} letter(s).\n";
        echo "Patient IDs used: " . implode(', ', $used_patient_ids) . "\n";

        return 0;
    }

    /**
     * Select up to $limit random existing patients.
     *
     * @param int $limit
     * @return Patient[]
     */
    private function pickPatients($limit)
    {
        $criteria = new CDbCriteria();
        $criteria->order = 'RAND()';
        $criteria->limit = $limit;

        return Patient::model()->findAll($criteria);
    }

    /**
     * Create a single Epatient letter event (with its element) for the patient.
     *
     * The Event is built via the core factory so episode/firm/institution context
     * is populated correctly; the element row is written directly because this
     * legacy module has no element factory and needs a unique epatient_id.
     *
     * @param Patient $patient
     * @param int $epatient_id unique legacy identifier for the element row
     */
    private function createLetter($patient, $epatient_id)
    {
        // Wrap the event and its element in a single transaction so a failure
        // while saving the element can never leave an orphaned event behind.
        $transaction = Yii::app()->db->beginTransaction();
        try {
            $event = Event::factory()
                ->forPatient($patient)
                ->forEventTypeWithName(self::EVENT_TYPE_NAME)
                ->create();

            $element = new Element_OphLeEpatientletter_EpatientLetter();
            $element->event_id = $event->id;
            $element->patient_id = $patient->id;
            $element->epatient_id = $epatient_id;
            $element->epatient_hosnum = (string)mt_rand(1000000, 9999999);
            $element->epatient_printed = mt_rand(0, 1);
            $element->epatient_cc_gp = $patient->gp_id ? 1 : 0;
            $element->recipient_html = $this->recipientHtml($patient);
            $element->date_html = date('j F Y', strtotime((string)$event->event_date));
            $element->letter_html = $this->letterHtml($patient);
            $element->importinfo = 'Seeded by SeedEpatientLettersCommand';
            $element->save(false);

            $transaction->commit();
        } catch (\Throwable $e) {
            $transaction->rollback();
            throw $e;
        }
    }

    /**
     * Build the recipient (name + address) block shown at the top of the letter.
     * Newlines are used as the delimiter because the view runs the value through
     * nl2br() when rendering.
     *
     * @param Patient $patient
     * @return string
     */
    private function recipientHtml($patient)
    {
        $name = (string)$patient->getCorrespondenceName();

        try {
            $address = (string)$patient->getSummaryAddress("\n");
        } catch (\Throwable $e) {
            $address = '';
        }

        return trim($name . ($address !== '' ? "\n" . $address : ''));
    }

    private function letterHtml($patient)
    {
        $name = htmlspecialchars((string)$patient->getFullName(), ENT_QUOTES, 'UTF-8');

        return "<p>Dear {$name},</p>"
            . "<p>This is a seeded Epatient letter generated for testing purposes.</p>"
            . "<p>Kind regards,<br/>OpenEyes</p>";
    }
}
