<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trouble-tickets-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'openedby'); ?>
		<?php echo $form->textField($model,'openedby'); ?>
		<?php echo $form->error($model,'openedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opendate'); ?>
		<?php echo $form->textField($model,'opendate'); ?>
		<?php echo $form->error($model,'opendate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'categoryid'); ?>
		<?php echo $form->textField($model,'categoryid'); ?>
		<?php echo $form->error($model,'categoryid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subjectid'); ?>
		<?php echo $form->textField($model,'subjectid'); ?>
		<?php echo $form->error($model,'subjectid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'closedbyuserid'); ?>
		<?php echo $form->textField($model,'closedbyuserid'); ?>
		<?php echo $form->error($model,'closedbyuserid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'closedate'); ?>
		<?php echo $form->textField($model,'closedate'); ?>
		<?php echo $form->error($model,'closedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'resolution'); ?>
		<?php echo $form->textArea($model,'resolution',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'resolution'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->