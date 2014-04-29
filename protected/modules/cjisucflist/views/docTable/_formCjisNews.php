<?php
/* @var $this DocTableController */
/* @var $model DocTable */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'fileUp'); ?>
		<?php echo $form->fileField($model, 'fileUp'); ?>
		<?php echo $form->error($model,'fileUp'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'buildNum'); ?>
		<?php echo $form->textField($model,'buildNum',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'buildNum'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'release_date'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'release_date',
				'language' => 'en',
				'i18nScriptFile' => 'jquery.ui.datepicker-en.js',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->release_date,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
			));
		?>
		<?php echo $form->error($model,'release_date'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'features'); ?>
		<?php echo $form->textArea($model,'features',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'features'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->