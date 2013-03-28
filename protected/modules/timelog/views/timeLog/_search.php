<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */
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
		<b>From:</b>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'from_date',  // name of post parameter
			'value'=>(isset(Yii::app()->request->cookies['from_date'])) ? Yii::app()->request->cookies['from_date']->value : '',  // value comes from cookie after submition
			'options' => array(
				'showAnim' => 'fold',
				'dateFormat' => 'mm/dd/yy', 
				'defaultDate' => $model->eventdate,
				'changeYear' => true,
				'changeMonth' => true,
				'showButtonPanel' => true,
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
		));
		?>
	
		<b>To:</b>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name'=>'to_date',
			'value'=>(isset(Yii::app()->request->cookies['to_date'])) ? Yii::app()->request->cookies['to_date']->value : '',
			'options' => array(
				'showAnim' => 'fold',
				'dateFormat' => 'mm/dd/yy', 
				'defaultDate' => $model->eventdate,
				'changeYear' => true,
				'changeMonth' => true,
				'showButtonPanel' => true,
			),
			'htmlOptions'=>array(
				'style'=>'height:20px;'
			),
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
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->