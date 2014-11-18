<?php
/* @var $this EvidenceController */
/* @var $model Evidence */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evidence-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cpn'); ?>
		<?php echo $form->textField($model,'cpn',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'cpn'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->