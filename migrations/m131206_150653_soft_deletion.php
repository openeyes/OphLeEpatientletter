<?php

class m131206_150653_soft_deletion extends CDbMigration
{
	public function up()
	{
		$this->addColumn('et_ophleepatientletter_epatientletter','deleted','tinyint(1) unsigned not null');
		$this->addColumn('et_ophleepatientletter_epatientletter_version','deleted','tinyint(1) unsigned not null');
	}

	public function down()
	{
		$this->dropColumn('et_ophleepatientletter_epatientletter','deleted');
		$this->dropColumn('et_ophleepatientletter_epatientletter_version','deleted');
	}
}
