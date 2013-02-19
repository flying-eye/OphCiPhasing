<?php
/**
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

<div class="element <?php echo $element->elementType->class_name ?>"
	data-element-type-id="<?php echo $element->elementType->id ?>"
	data-element-type-class="<?php echo $element->elementType->class_name ?>"
	data-element-type-name="<?php echo $element->elementType->name ?>"
	data-element-display-order="<?php echo $element->elementType->display_order ?>">
	<?php
	$instruments = $element->getInstrumentOptions();
	$key = 0;
	?>
	<div class="cols2 clearfix">
		<input type="hidden" name="intraocularpressure_readings_valid" value="1" />
		<?php echo $form->hiddenInput($element, 'eye_id', false, array('class' => 'sideField')); ?>
		<div
			class="side left eventDetail<?php if(!$element->hasRight()) { ?> inactive<?php } ?>"
			data-side="right">
			<div class="activeForm">
				<a href="#" class="removeSide">-</a>
				<?php echo $form->dropDownList($element, 'right_instrument_id', $instruments)?>
				<?php echo $form->radioBoolean($element, 'right_dilated')?>
				<div class="eventDetail">
					<div class="label">Readings:</div>
					<div class="data">
						<table>
							<thead>
								<tr>
									<th>Time (HH:MM)</th>
									<th>mm Hg</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$right_readings = (isset($_POST['intraocularpressure_readings_valid']) ? $element->convertReadings(@$_POST['intraocularpressure_reading'], 'right') : $element->right_readings);
									if($right_readings) {
										foreach($right_readings as $index => $reading) { 
											$this->renderPartial('_form_Element_OphCiPhasing_IntraocularPressure_Reading', array(
												'key' => $key,
												'reading' => $reading,
												'side' => $reading->side,
												'no_remove' => ($index == 0)
											));
											$key++;
										}
									} else { 
										$this->renderPartial('_form_Element_OphCiPhasing_IntraocularPressure_Reading', array(
											'key' => $key,
											'side' => 0,
											'no_remove' => true
										));
										$key++;
									}
								?>
							</tbody>
						</table>
						<button class="addReading classy green mini" type="button">
							<span class="button-span button-span-green">Add</span>
						</button>
					</div>
				</div>
				<?php echo $form->textArea($element, 'right_comments', array('class' => 'autosize', 'rows' => 1, 'cols' => 62)) ?>
			</div>
			<div class="inactiveForm">
				<a href="#">Add right side</a>
			</div>
		</div>
		<div
			class="side right eventDetail<?php if(!$element->hasLeft()) { ?> inactive<?php } ?>"
			data-side="left">
			<div class="activeForm">
				<a href="#" class="removeSide">-</a>
				<?php echo $form->dropDownList($element, 'left_instrument_id', $instruments)?>
				<?php echo $form->radioBoolean($element, 'left_dilated')?>
				<div class="eventDetail">
					<div class="label">Readings:</div>
					<div class="data">
						<table>
							<thead>
								<tr>
									<th>Time (HH:MM)</th>
									<th>mm Hg</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$left_readings = (isset($_POST['intraocularpressure_readings_valid']) ? $element->convertReadings(@$_POST['intraocularpressure_reading'], 'left') : $element->left_readings);
									if($left_readings) {
										foreach($left_readings as $index => $reading) {
											$this->renderPartial('_form_Element_OphCiPhasing_IntraocularPressure_Reading', array(
												'key' => $key,
												'reading' => $reading,
												'side' => $reading->side,
												'no_remove' => ($index == 0)
											));
											$key++;
										}
									} else { 
										$this->renderPartial('_form_Element_OphCiPhasing_IntraocularPressure_Reading', array(
											'key' => $key,
											'side' => 1,
											'no_remove' => true
										));
										$key++;
									}
								?>
							</tbody>
						</table>
						<button class="addReading classy green mini" type="button">
							<span class="button-span button-span-green">Add</span>
						</button>
					</div>
				</div>
				<?php echo $form->textArea($element, 'left_comments', array('class' => 'autosize', 'rows' => 1, 'cols' => 62)) ?>
			</div>
			<div class="inactiveForm">
				<a href="#">Add left side</a>
			</div>
		</div>
	</div>
</div>
<script id="intraocularpressure_reading_template" type="text/html">
	<?php
	$this->renderPartial('_form_Element_OphCiPhasing_IntraocularPressure_Reading', array(
			'key' => '{{key}}',
			'side' => '{{side}}',
	));
	?>
</script>
