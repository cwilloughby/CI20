<?php
/* @var $this CentriodController */
/* @var $centriod Centriod */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'centriod-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($centriod); ?>

	<div class="row">
		<?php echo $form->labelEx($centriod,'arrestnumber'); ?>
		<?php echo $form->textField($centriod,'arrestnumber',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($centriod,'arrestnumber'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->