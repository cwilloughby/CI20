<?php
/* @var $this GsTimeLogController */
/* @var $model GsTimeLog */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'enableAjaxValidation'=>true,
)); ?>

	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'computername'); ?>
		<?php echo $form->textField($model,'computername',array('size'=>15,'maxlength'=>15)); ?>
	</div>
	
	<div class="row">
		<b>Date Range (MM/DD/YYYY)</b>
	</div>
	
	<div class="row">
		<?php
		$this->widget('RangeInputField', array(
			'model' => $model,
			'attributeFrom' => 'from_date',
			'attributeTo' => 'to_date',
		));
		?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eventtype'); ?>
		<?php echo $form->dropDownList($model, 'eventtype', array(''=>'', 'login'=>'Login', 'logoff'=>'Logoff')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eventtime'); ?>
		<?php echo $form->textField($model,'eventtime'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
		<?php echo CHtml::submitButton('Export', array('id'=>'export-button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->