<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'reporter'); ?>
		<?php echo $form->textField($model,'reporter',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'summary'); ?>
		<?php echo $form->textArea($model,'summary',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'assigned'); ?>
		<?php echo $form->textField($model,'assigned',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'updated'); ?>
		<?php echo $form->textField($model,'updated'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'originalestimate'); ?>
		<?php echo $form->textField($model,'originalestimate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'remainingestimate'); ?>
		<?php echo $form->textField($model,'remainingestimate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'timespent'); ?>
		<?php echo $form->textField($model,'timespent'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resolution'); ?>
		<?php echo $form->textField($model,'resolution',array('size'=>45,'maxlength'=>45)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'priority'); ?>
		<?php echo $form->textField($model,'priority',array('size'=>10,'maxlength'=>10)); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->