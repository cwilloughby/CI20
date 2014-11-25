<?php
/* @var $this DocumentsProcessorController */
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

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'signed'); ?>
		<?php echo $form->textField($model,'signed'); ?>
		<?php echo $form->error($model,'signed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'disabled'); ?>
		<?php echo $form->textField($model,'disabled'); ?>
		<?php echo $form->error($model,'disabled'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shareable'); ?>
		<?php echo $form->textField($model,'shareable'); ?>
		<?php echo $form->error($model,'shareable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->