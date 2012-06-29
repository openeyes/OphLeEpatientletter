
<h4 class="elementTypeName"><?php  echo $element->elementType->name ?></h4>

<table class="subtleWhite normalText">
	<tbody>
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
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('letter_html'))?>:</td>
				<td><span class="big"> <?php  echo $element->letter_html ? 'Yes' : 'No' ?></span></td>
			</tr>
								<tr>
				<td width="30%"><?php  echo CHtml::encode($element->getAttributeLabel('patient_id'))?>:</td>
				<td><span class="big"><?php  echo $element->patient_id ?></span></td>
			</tr>
						</tbody>
</table>
