<?php
/**
 * OpenEyes
 *
 * (C) Moorfields Eye Hospital NHS Foundation Trust, 2008-2011
 * (C) OpenEyes Foundation, 2011-2013
 * This file is part of OpenEyes.
 * OpenEyes is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 * OpenEyes is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License along with OpenEyes in a file titled COPYING. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package OpenEyes
 * @link http://www.openeyes.org.uk
 * @author OpenEyes <info@openeyes.org.uk>
 * @copyright Copyright (c) 2008-2011, Moorfields Eye Hospital NHS Foundation Trust
 * @copyright Copyright (c) 2011-2013, OpenEyes Foundation
 * @license http://www.gnu.org/licenses/gpl-3.0.html The GNU General Public License V3.0
 */

/**
 * This is the model class for table "et_ophleepatientletter_epatientletter".
 *
 * The followings are the available columns in table:
 * @property string $id
 * @property integer $event_id
 * @property string $epatient_id
 * @property string $epatient_printed
 * @property string $epatient_cc_gp
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
			array('event_id, epatient_id, epatient_printed, epatient_cc_gp, epatient_hosnum, letter_html, patient_id', 'safe'),
			# array('epatient_id, epatient_recipient_type, epatient_letter_date, epatient_created_by, epatient_recipient_data, epatient_contact_data, epatient_date_data, epatient_letter_body, epatient_printed, epatient_patient_episode_id, epatient_location_id, epatient_cc_gp, epatient_letter_set, epatient_person_id, epatient_hosnum, letter_html, patient_id, ', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, event_id, epatient_id, epatient_printed, epatient_cc_gp, epatient_hosnum, letter_html, patient_id', 'safe', 'on' => 'search'),
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
			'epatient_printed' => 'Epatient Printed',
			'epatient_cc_gp' => 'Epatient CC GP',
			'epatient_hosnum' => 'Epatient Hosnum',
			'letter_html' => 'Letter body',
			'recipient_html' => 'Recipient',
			'date_html' => 'Date sent',
			'patient_id' => 'Patient ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id, true);
		$criteria->compare('event_id', $this->event_id, true);
		$criteria->compare('epatient_id', $this->epatient_id);
		$criteria->compare('epatient_printed', $this->epatient_printed);
		$criteria->compare('epatient_cc_gp', $this->epatient_cc_gp);
		$criteria->compare('epatient_hosnum', $this->epatient_hosnum);
		$criteria->compare('letter_html', $this->letter_html);
		$criteria->compare('patient_id', $this->patient_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria' => $criteria,
		));
	}
}
