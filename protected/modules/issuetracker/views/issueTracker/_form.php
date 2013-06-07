<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issue-tracker-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reporter'); ?>
		<?php echo $form->textField($model,'reporter',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'reporter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'summary'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assigned'); ?>
		<?php echo $form->textField($model,'assigned',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'assigned'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'originalestimate'); ?>
		<?php echo $form->textField($model,'originalestimate'); ?>
		<?php echo $form->error($model,'originalestimate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'remainingestimate'); ?>
		<?php echo $form->textField($model,'remainingestimate'); ?>
		<?php echo $form->error($model,'remainingestimate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'timespent'); ?>
		<?php echo $form->textField($model,'timespent'); ?>
		<?php echo $form->error($model,'timespent'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resolution'); ?>
		<?php echo $form->textField($model,'resolution',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'resolution'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->