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
 ?>
<div class="<?php echo $element->elementType->class_name?>">
	<h4 class="elementTypeName"><?php  echo $element->elementType->name; ?></h4>

			<?php echo $form->textField($element, 'epatient_id', array('size' => '10')); ?>
			<?php echo $form->textField($element, 'epatient_recipient_type', array('size' => '10')); ?>
	
		<?php echo $form->datePicker($element, 'epatient_letter_date', array('maxDate' => 'today'), array('style'=>'width: 110px;')); ?>
			<?php echo $form->textField($element, 'epatient_created_by', array('size' => '10')); ?>
	
		<?php echo $form->textArea($element, 'epatient_recipient_data', array('rows' => 6, 'cols' => 80)); ?>
	
		<?php echo $form->textArea($element, 'epatient_contact_data', array('rows' => 6, 'cols' => 80)); ?>
	
		<?php echo $form->textArea($element, 'epatient_date_data', array('rows' => 6, 'cols' => 80)); ?>
	
		<?php echo $form->textArea($element, 'epatient_letter_body', array('rows' => 6, 'cols' => 80)); ?>
	
		<?php echo $form->radioBoolean($element, 'epatient_printed'); ?>
			<?php echo $form->textField($element, 'epatient_patient_episode_id', array('size' => '10')); ?>
			<?php echo $form->textField($element, 'epatient_location_id', array('size' => '10')); ?>
	
		<?php echo $form->radioBoolean($element, 'epatient_cc_gp'); ?>
			<?php echo $form->textField($element, 'epatient_letter_set', array('size' => '10')); ?>
			<?php echo $form->textField($element, 'epatient_person_id', array('size' => '10')); ?>
			<?php echo $form->textField($element, 'epatient_hosnum', array('size' => '10')); ?>
	
		<?php echo $form->radioBoolean($element, 'letter_html'); ?>
			<?php echo $form->textField($element, 'patient_id', array('size' => '10')); ?>
	</div>
