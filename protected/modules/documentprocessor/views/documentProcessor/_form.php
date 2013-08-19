<?php
/* @var $this DocumentsController */
/* @var $model Documents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'documents-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'uploader'); ?>
		<?php echo $form->textField($model,'uploader'); ?>
		<?php echo $form->error($model,'uploader'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'documentname'); ?>
		<?php echo $form->textField($model,'documentname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'documentname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'path'); ?>
		<?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'uploaddate'); ?>
		<?php echo $form->textField($model,'uploaddate'); ?>
		<?php echo $form->error($model,'uploaddate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->