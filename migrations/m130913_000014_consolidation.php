<?php

class m130913_000014_consolidation extends OEMigration
{

	public function up()
	{
		if (!$this->consolidate(
			array(
				'm120627_165000_event_type_OphLeEpatientletter',
				'm120918_094344_drop_unnecessary_fields',
			)
		)
		) {
			$this->createTables();
		}
	}

	public function down()
	{
		echo "You cannot migrate down past a consolidation migration\n";
		return false;
	}

	public function safeUp()
	{
		$this->up();
	}

	public function safeDown()
	{
		$this->down();
	}

	protected function createTables()
	{
		// --- EVENT TYPE ENTRIES ---

		// create an event_type entry for this event type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('event_type')->where(
			'name=:name',
			array(':name' => 'Epatient letter')
		)->queryRow()
		) {
			$group = $this->dbConnection->createCommand()->select('id')->from('event_group')->where(
				'name=:name',
				array(':name' => 'Legacy data')
			)->queryRow();
			$this->insert(
				'event_type',
				array(
					'class_name' => 'OphLeEpatientletter',
					'name' => 'Epatient letter',
					'event_group_id' => $group['id']
				)
			);
		}
		// select the event_type id for this event type name
		$event_type = $this->dbConnection->createCommand()->select('id')->from('event_type')->where(
			'name=:name',
			array(':name' => 'Epatient letter')
		)->queryRow();

		// --- ELEMENT TYPE ENTRIES ---

		// create an element_type entry for this element type name if one doesn't already exist
		if (!$this->dbConnection->createCommand()->select('id')->from('element_type')->where(
			'name=:name and event_type_id=:eventTypeId',
			array(':name' => 'Epatient letter', ':eventTypeId' => $event_type['id'])
		)->queryRow()
		) {
			$this->insert(
				'element_type',
				array(
					'name' => 'Epatient letter',
					'class_name' => 'Element_OphLeEpatientletter_EpatientLetter',
					'event_type_id' => $event_type['id'],
					'display_order' => 1
				)
			);
		}
		// select the element_type_id for this element type name
		$element_type = $this->dbConnection->createCommand()->select('id')->from('element_type')->where(
			'event_type_id=:eventTypeId and name=:name',
			array(':eventTypeId' => $event_type['id'], ':name' => 'Epatient letter')
		)->queryRow();


		// create the table for this element type: et_modulename_elementtypename
		$this->createTable(
			'et_ophleepatientletter_epatientletter',
			array(
				'id' => 'int(10) unsigned NOT NULL AUTO_INCREMENT',
				'event_id' => 'int(10) unsigned NOT NULL',
				'epatient_id' => 'int(10) NOT NULL',
				'epatient_printed' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'epatient_cc_gp' => 'tinyint(1) unsigned NOT NULL DEFAULT 0',
				'epatient_hosnum' => 'varchar(255) DEFAULT \'\'',
				'importinfo' => 'varchar(255) DEFAULT \'\'',
				'patient_id' => 'int(10) unsigned DEFAULT NULL',
				'letter_html' => 'text DEFAULT NULL',
				'recipient_html' => 'text DEFAULT NULL',
				'date_html' => 'text DEFAULT NULL',
				'last_modified_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'last_modified_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'created_user_id' => 'int(10) unsigned NOT NULL DEFAULT 1',
				'created_date' => 'datetime NOT NULL DEFAULT \'1901-01-01 00:00:00\'',
				'PRIMARY KEY (`id`)',
				'KEY `et_ophleepatientletter_epatientletter_lmui_fk` (`last_modified_user_id`)',
				'KEY `et_ophleepatientletter_epatientletter_cui_fk` (`created_user_id`)',
				'KEY `et_ophleepatientletter_epatientletter_ev_fk` (`event_id`)',
				'CONSTRAINT `et_ophleepatientletter_epatientletter_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophleepatientletter_epatientletter_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`)',
				'CONSTRAINT `et_ophleepatientletter_epatientletter_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)',
			),
			'ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin'
		);
		$this->createIndex(
			'idx_et_ophleepatientletter_epatientletter_epatient_hosnum',
			'et_ophleepatientletter_epatientletter',
			'epatient_hosnum'
		);
		$this->execute("ALTER TABLE et_ophleepatientletter_epatientletter ADD UNIQUE (epatient_id)");
	}
}
