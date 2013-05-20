<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'evaluationid'); ?>
		<?php echo $form->textField($model,'evaluationid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'employee'); ?>
		<?php echo $form->textField($model,'employee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evaluator'); ?>
		<?php echo $form->textField($model,'evaluator'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'evaluationdate'); ?>
		<?php echo $form->textField($model,'evaluationdate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->