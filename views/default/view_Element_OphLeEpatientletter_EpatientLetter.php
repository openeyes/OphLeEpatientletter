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
 ?>
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('recipient_html'))?>:</td>
				<td><span class="big"> <?php  echo nl2br(CHtml::decode($element->recipient_html))?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('date_html'))?>:</td>
				<td><span class="big"> <?php  echo nl2br(CHtml::decode($element->date_html))?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('letter_html'))?>:</td>
				<td><span class="big">
					<?php
						$bold = false;
						foreach (explode("\n",nl2br(CHtml::decode($element->letter_html))) as $line) {
							if (preg_match("/RE:/i", $line)) {
								echo "<b>".$line."\n";
								$bold = true;
							} else {
								if ($bold == true) {
									echo $line."</b>\n";
								} else {
									echo $line."\n";
								}
							}
						};
					?></span></td>
			</tr>
		<?php /*
			<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_id'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_id ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_recipient_type'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_recipient_type ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_letter_date'))?>:</td>
				<td><span class="big"><?php  echo CHtml::encode($element->NHSDate('epatient_letter_date')); ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_created_by'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_created_by ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_recipient_data'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_recipient_data ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_contact_data'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_contact_data ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_date_data'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_date_data ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_letter_body'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_letter_body ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_printed'))?>:</td>
				<td><span class="big"> <?php  echo $element->epatient_printed ? 'Yes' : 'No' ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_patient_episode_id'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_patient_episode_id ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_location_id'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_location_id ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_cc_gp'))?>:</td>
				<td><span class="big"> <?php  echo $element->epatient_cc_gp ? 'Yes' : 'No' ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_letter_set'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_letter_set ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_person_id'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_person_id ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('epatient_hosnum'))?>:</td>
				<td><span class="big"><?php  echo $element->epatient_hosnum ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('patient_id'))?>:</td>
				<td><span class="big"><?php  echo $element->patient_id ?></span></td>
			</tr>
		*/ ?>
						</tbody>
</table>
