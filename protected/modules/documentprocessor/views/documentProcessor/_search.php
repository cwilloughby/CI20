<?php
/* @var $this DocumentsController */
/* @var $model Documents */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'documentid'); ?>
		<?php echo $form->textField($model,'documentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uploader'); ?>
		<?php echo $form->textField($model,'uploader'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'documentname'); ?>
		<?php echo $form->textField($model,'documentname',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'path'); ?>
		<?php echo $form->textField($model,'path',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'uploaddate'); ?>
		<?php echo $form->textField($model,'uploaddate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->