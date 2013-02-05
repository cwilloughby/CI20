<?php
/* @var $this HrSectionsController */
/* @var $model HrSections */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'sectionid'); ?>
		<?php echo $form->textField($model,'sectionid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'section'); ?>
		<?php echo $form->textArea($model,'section',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'datemade'); ?>
		<?php echo $form->textField($model,'datemade'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->