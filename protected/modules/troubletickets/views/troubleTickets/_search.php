<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ticketid'); ?>
		<?php echo $form->textField($model,'ticketid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'openedby'); ?>
		<?php echo $form->textField($model,'openedby'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'opendate'); ?>
		<?php echo $form->textField($model,'opendate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'categoryid'); ?>
		<?php echo $form->textField($model,'categoryid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'subjectid'); ?>
		<?php echo $form->textField($model,'subjectid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'closedbyuserid'); ?>
		<?php echo $form->textField($model,'closedbyuserid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'closedate'); ?>
		<?php echo $form->textField($model,'closedate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resolution'); ?>
		<?php echo $form->textArea($model,'resolution',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->