<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'device-inventory-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'equipmenttype'); ?>
		<?php echo $form->textField($model,'equipmenttype',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'equipmenttype'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'devicename'); ?>
		<?php echo $form->textField($model,'devicename',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'devicename'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'enabled'); ?>
		<?php echo $form->dropDownList($model,'enabled', array(1=>'Yes', 0=>'No')); ?>
		<?php echo $form->error($model,'enabled'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'indate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'indate',
				'language' => 'en',
				'id'=>'in_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->indate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'outdate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'outdate',
				'language' => 'en',
				'id'=>'out_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->outdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'model'); ?>
		<?php echo $form->textField($model,'model',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'model'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'serial'); ?>
		<?php echo $form->textField($model,'serial',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'serial'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textArea($model,'comments',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'warrentyenddate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'warrentyenddate',
				'language' => 'en',
				'id'=>'warrent_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->warrentyenddate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'revolvedate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'revolvedate',
				'language' => 'en',
				'id'=>'revolve_date',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->revolvedate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->