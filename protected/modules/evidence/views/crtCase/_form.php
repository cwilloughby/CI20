<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'crt-case-form',
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
		<?php echo $form->labelEx($model,'crtdiv'); ?>
		<?php echo $form->textField($model,'crtdiv',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'crtdiv'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cptno'); ?>
		<?php echo $form->textField($model,'cptno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'cptno'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->