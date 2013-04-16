<?php
/* @var $this DefendantController */
/* @var $model Defendant */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'defendant-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'fname'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'fname',
			'sourceUrl' => Yii::app()->createUrl('evidence/defendant/DefendantFirstNameLookup'),
			'options' => array(
				'minLength' => '1',
			),
		));?>
		<?php echo $form->error($model,'fname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lname'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
			'model' => $model,
			'attribute' => 'lname',
			'sourceUrl' => Yii::app()->createUrl('evidence/defendant/DefendantLastNameLookup'),
			'options' => array(
				'minLength' => '1',
			),
		));?>
		<?php echo $form->error($model,'lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'oca'); ?>
		<?php echo $form->textField($model,'oca'); ?>
		<?php echo $form->error($model,'oca'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->