<?php
/* @var $this DeviceHistoricController */
/* @var $model DeviceHistoric */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,	'device_search'); ?>
		<?php echo $form->textField($model,	'device_search',array('size'=>30,'maxlength'=>30)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'username'); ?>
		<?php echo $form->textField($model,'username',array('size'=>45,'maxlength'=>45)); ?>
	</div>

    <div class="row">
        <?php echo $form->label($model,'location'); ?>
        <?php echo $form->textField($model,'location',array('size'=>45,'maxlength'=>45)); ?>
    </div>

	<div class="row">
		<?php echo $form->label($model,'datechanged'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'datechanged',
				'language' => 'en',
				'id'=>'warrent_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->datechanged,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->