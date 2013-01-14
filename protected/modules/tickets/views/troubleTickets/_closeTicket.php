<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'close-tickets-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'resolution'); ?>
		<?php echo $form->textArea($model,'resolution',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'resolution'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Close'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->