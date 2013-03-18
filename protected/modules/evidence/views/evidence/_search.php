<?php
/* @var $this EvidenceController */
/* @var $model Evidence */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exhibitno'); ?>
		<?php echo $form->textField($model,'exhibitno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evidencename'); ?>
		<?php echo $form->textField($model,'evidencename'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dateadded'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'dateadded',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd', 
					'defaultDate' => $model->dateadded,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'exhibitlist'); ?>
		<?php echo $form->textField($model,'exhibitlist'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->