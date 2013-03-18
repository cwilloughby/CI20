<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'crtdiv'); ?>
		<?php echo $form->textField($model,'crtdiv'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cptno'); ?>
		<?php echo $form->textField($model,'cptno'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->