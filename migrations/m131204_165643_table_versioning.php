<?php

class m131204_165643_table_versioning extends CDbMigration
{
	public function up()
	{
		$this->execute("
CREATE TABLE `et_ophleepatientletter_epatientletter_version` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`event_id` int(10) unsigned NOT NULL,
	`epatient_id` int(10) NOT NULL,
	`epatient_printed` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`epatient_cc_gp` tinyint(1) unsigned NOT NULL DEFAULT '0',
	`epatient_hosnum` varchar(255) DEFAULT '',
	`importinfo` varchar(255) DEFAULT '',
	`patient_id` int(10) unsigned DEFAULT NULL,
	`letter_html` text,
	`recipient_html` text,
	`date_html` text,
	`last_modified_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`last_modified_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	`created_user_id` int(10) unsigned NOT NULL DEFAULT '1',
	`created_date` datetime NOT NULL DEFAULT '1901-01-01 00:00:00',
	PRIMARY KEY (`id`),
	KEY `acv_et_ophleepatientletter_epatientletter_lmui_fk` (`last_modified_user_id`),
	KEY `acv_et_ophleepatientletter_epatientletter_cui_fk` (`created_user_id`),
	KEY `acv_et_ophleepatientletter_epatientletter_ev_fk` (`event_id`),
	KEY `acv_idx_et_ophleepatientletter_epatientletter_epatient_hosnum` (`epatient_hosnum`),
	CONSTRAINT `acv_et_ophleepatientletter_epatientletter_lmui_fk` FOREIGN KEY (`last_modified_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophleepatientletter_epatientletter_cui_fk` FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`),
	CONSTRAINT `acv_et_ophleepatientletter_epatientletter_ev_fk` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
		");

		$this->alterColumn('et_ophleepatientletter_epatientletter_version','id','int(10) unsigned NOT NULL');
		$this->dropPrimaryKey('id','et_ophleepatientletter_epatientletter_version');

		$this->createIndex('et_ophleepatientletter_epatientletter_aid_fk','et_ophleepatientletter_epatientletter_version','id');

		$this->addColumn('et_ophleepatientletter_epatientletter_version','version_date',"datetime not null default '1900-01-01 00:00:00'");

		$this->addColumn('et_ophleepatientletter_epatientletter_version','version_id','int(10) unsigned NOT NULL');
		$this->addPrimaryKey('version_id','et_ophleepatientletter_epatientletter_version','version_id');
		$this->alterColumn('et_ophleepatientletter_epatientletter_version','version_id','int(10) unsigned NOT NULL AUTO_INCREMENT');
	}

	public function down()
	{
		$this->dropTable('et_ophleepatientletter_epatientletter_version');
	}
}
