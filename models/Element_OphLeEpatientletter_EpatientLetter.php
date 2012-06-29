<?php /**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2012
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2012, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophleepatientletter_epatientletter".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $epatient_id
 * @property string $epatient_recipient_type
 * @property string $epatient_letter_date
 * @property string $epatient_created_by
 * @property string $epatient_recipient_data
 * @property string $epatient_contact_data
 * @property string $epatient_date_data
 * @property string $epatient_letter_body
 * @property string $epatient_printed
 * @property string $epatient_patient_episode_id
 * @property string $epatient_location_id
 * @property string $epatient_cc_gp
 * @property string $epatient_letter_set
 * @property string $epatient_person_id
 * @property string $epatient_hosnum
 * @property string $letter_html
 * @property string $patient_id
 *
 * The followings are the available model relations:
 */

class Element_OphLeEpatientletter_EpatientLetter extends BaseEventTypeElement
{
	public $service;

	/**
	 * Returns the static model of the specified AR class.
	 * @return the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'et_ophleepatientletter_epatientletter';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('event_id, epatient_id, epatient_recipient_type, epatient_letter_date, epatient_created_by, epatient_recipient_data, epatient_contact_data, epatient_date_data, epatient_letter_body, epatient_printed, epatient_patient_episode_id, epatient_location_id, epatient_cc_gp, epatient_letter_set, epatient_person_id, epatient_hosnum, letter_html, patient_id, ', 'safe'),
			# array('epatient_id, epatient_recipient_type, epatient_letter_date, epatient_created_by, epatient_recipient_data, epatient_contact_data, epatient_date_data, epatient_letter_body, epatient_printed, epatient_patient_episode_id, epatient_location_id, epatient_cc_gp, epatient_letter_set, epatient_person_id, epatient_hosnum, letter_html, patient_id, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, epatient_id, epatient_recipient_type, epatient_letter_date, epatient_created_by, epatient_recipient_data, epatient_contact_data, epatient_date_data, epatient_letter_body, epatient_printed, epatient_patient_episode_id, epatient_location_id, epatient_cc_gp, epatient_letter_set, epatient_person_id, epatient_hosnum, letter_html, patient_id, ', 'safe', 'on' => 'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'element_type' => array(self::HAS_ONE, 'ElementType', 'id','on' => "element_type.class_name='".get_class($this)."'"),
			'eventType' => array(self::BELONGS_TO, 'EventType', 'event_type_id'),
			'event' => array(self::BELONGS_TO, 'Event', 'event_id'),
			'user' => array(self::BELONGS_TO, 'User', 'created_user_id'),
			'usermodified' => array(self::BELONGS_TO, 'User', 'last_modified_user_id'),
					);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'event_id' => 'Event',
'epatient_id' => 'Epatient ID',
'epatient_recipient_type' => 'Epatient Recipient Type',
'epatient_letter_date' => 'Epatient Letter date',
'epatient_created_by' => 'Epatient Created By',
'epatient_recipient_data' => 'Epatient Recipient Data',
'epatient_contact_data' => 'Epatient Contact Data',
'epatient_date_data' => 'Epatient Date Data',
'epatient_letter_body' => 'Epatient Letter Body',
'epatient_printed' => 'Epatient Printed',
'epatient_patient_episode_id' => 'Epatient Patient Episode ID',
'epatient_location_id' => 'Epatient Location ID',
'epatient_cc_gp' => 'Epatient CC GP',
'epatient_letter_set' => 'Epatient Letter Set',
'epatient_person_id' => 'Epatient Person ID',
'epatient_hosnum' => 'Epatient Hosnum',
'letter_html' => 'Letter HTML',
'patient_id' => 'Patient ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);

$criteria->compare('epatient_id', $this->epatient_id);
$criteria->compare('epatient_recipient_type', $this->epatient_recipient_type);
$criteria->compare('epatient_letter_date', $this->epatient_letter_date);
$criteria->compare('epatient_created_by', $this->epatient_created_by);
$criteria->compare('epatient_recipient_data', $this->epatient_recipient_data);
$criteria->compare('epatient_contact_data', $this->epatient_contact_data);
$criteria->compare('epatient_date_data', $this->epatient_date_data);
$criteria->compare('epatient_letter_body', $this->epatient_letter_body);
$criteria->compare('epatient_printed', $this->epatient_printed);
$criteria->compare('epatient_patient_episode_id', $this->epatient_patient_episode_id);
$criteria->compare('epatient_location_id', $this->epatient_location_id);
$criteria->compare('epatient_cc_gp', $this->epatient_cc_gp);
$criteria->compare('epatient_letter_set', $this->epatient_letter_set);
$criteria->compare('epatient_person_id', $this->epatient_person_id);
$criteria->compare('epatient_hosnum', $this->epatient_hosnum);
$criteria->compare('letter_html', $this->letter_html);
$criteria->compare('patient_id', $this->patient_id);

		return new CActiveDataProvider(get_class($this), array(
				'criteria' => $criteria,
			));
	}

	/**
	 * Set default values for forms on create
	 */
	public function setDefaultOptions()
	{
	}



	protected function beforeSave()
	{
		return parent::beforeSave();
	}

	protected function afterSave()
	{

		return parent::afterSave();
	}

	protected function beforeValidate()
	{
		return parent::beforeValidate();
	}
}
?>
