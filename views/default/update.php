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
<?php 	$this->breadcrumbs=array($this->module->id);
	$this->header();
?>
<h3 class="withEventIcon" style="background:transparent url(<?php echo $this->assetPath?>/img/medium.png) center left no-repeat;"><?php echo $this->event_type->name ?></h3>

<div>
	<?php 		$form = $this->beginWidget('BaseEventTypeCActiveForm', array(
			'id'=>'clinical-create',
			'enableAjaxValidation'=>false,
			'htmlOptions' => array('class'=>'sliding'),
			'focus'=>'#procedure_id'
		));
	?>
	<?php  $this->displayErrors($errors)?>
	<?php  $this->renderDefaultElements($this->action->id, $form); ?>
	<?php  $this->renderOptionalElements($this->action->id, $form); ?>
	<?php  $this->displayErrors($errors)?>
		<div class="cleartall"></div>
		<div class="form_button">
			<img class="loader" style="display: none;" src="/img/ajax-loader.gif" alt="loading..." />&nbsp;
			<button type="submit" class="classy green venti" id="et_save" name="save"><span class="button-span button-span-green">Save</span></button>
			<button type="submit" class="classy red venti" id="et_cancel" name="cancel"><span class="button-span button-span-red">Cancel</span></button>
		</div>
	<?php  $this->endWidget(); ?></div>

<?php  $this->footer(); ?>
