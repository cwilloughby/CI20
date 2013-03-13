<?php
/* @var $this LogController */
/* @var $model Log */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'eventid'); ?>
		<?php echo $form->textField($model,'eventid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'userid'); ?>
		<?php echo $form->textField($model,'userid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tablename'); ?>
		<?php echo $form->textField($model,'tablename',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'tablerow'); ?>
		<?php echo $form->textField($model,'tablerow',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eventdate'); ?>
		<?php echo $form->textField($model,'eventdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'event'); ?>
		<?php echo $form->textField($model,'event',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->