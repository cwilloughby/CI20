<?php
/* @var $this GsTimeLogController */
/* @var $model GsTimeLog */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gs-time-log-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
		<?php echo $form->error($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'computername'); ?>
		<?php echo $form->textField($model,'computername',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'computername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eventtype'); ?>
		<?php echo $form->textField($model,'eventtype',array('size'=>7,'maxlength'=>7)); ?>
		<?php echo $form->error($model,'eventtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eventtime'); ?>
		<?php echo $form->textField($model,'eventtime'); ?>
		<?php echo $form->error($model,'eventtime'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'eventdate'); ?>
		<?php echo $form->textField($model,'eventdate'); ?>
		<?php echo $form->error($model,'eventdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->