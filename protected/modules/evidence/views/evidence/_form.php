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
		<?php echo $form->textField($model,'caseno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'caseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'exhibitno'); ?>
		<?php echo $form->textField($model,'exhibitno',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'exhibitno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'evidencename'); ?>
		<?php echo $form->textField($model,'evidencename',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'evidencename'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dateadded'); ?>
		<?php echo $form->textField($model,'dateadded'); ?>
		<?php echo $form->error($model,'dateadded'); ?>
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