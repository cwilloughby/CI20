<?php
/* @var $this EvidenceController */
/* @var $model Evidence */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evidence-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno'); ?>
		<?php echo $form->error($model,'caseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exhibitno'); ?>
		<?php echo $form->textField($model,'exhibitno'); ?>
		<?php echo $form->error($model,'exhibitno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'evidencename'); ?>
		<?php echo $form->textField($model,'evidencename'); ?>
		<?php echo $form->error($model,'evidencename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment'); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exhibitlist'); ?>
		<?php echo $form->textField($model,'exhibitlist'); ?>
		<?php echo $form->error($model,'exhibitlist'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->