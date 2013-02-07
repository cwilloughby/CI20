<?php
/* @var $this HrPolicyController */
/* @var $model HrSection */
/* @var $form CActiveForm */
/* @var $id Integer */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hr-section-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php echo $form->hiddenField($model,'policyid'); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'section'); ?>
		<?php echo $form->textArea($model,'section',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'section'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
