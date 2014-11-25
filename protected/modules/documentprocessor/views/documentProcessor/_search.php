<?php
/* @var $this DocumentsProcessorController */
/* @var $model Documents */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'documentname'); ?>
		<?php echo $form->textField($model,'documentname',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uploaddate'); ?>
		<?php echo $form->textField($model,'uploaddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ext'); ?>
		<?php echo $form->textField($model,'ext'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'modifieddate'); ?>
		<?php echo $form->textField($model,'modifieddate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'signed'); ?>
		<?php echo $form->textField($model,'signed'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'disabled'); ?>
		<?php echo $form->textField($model,'disabled'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'shareable'); ?>
		<?php echo $form->textField($model,'shareable'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->