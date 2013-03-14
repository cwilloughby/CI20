<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'case-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'defid'); ?>
		<?php echo $form->textField($model,'defid'); ?>
		<?php echo $form->error($model,'defid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'caseno'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dispodate'); ?>
		<?php echo $form->textField($model,'dispodate'); ?>
		<?php echo $form->error($model,'dispodate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hearingdate'); ?>
		<?php echo $form->textField($model,'hearingdate'); ?>
		<?php echo $form->error($model,'hearingdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hearingtype'); ?>
		<?php echo $form->textField($model,'hearingtype',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'hearingtype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'page'); ?>
		<?php echo $form->textField($model,'page',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'page'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'sentence'); ?>
		<?php echo $form->textField($model,'sentence',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'sentence'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'indate'); ?>
		<?php echo $form->textField($model,'indate'); ?>
		<?php echo $form->error($model,'indate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'outdate'); ?>
		<?php echo $form->textField($model,'outdate'); ?>
		<?php echo $form->error($model,'outdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'destructiondate'); ?>
		<?php echo $form->textField($model,'destructiondate'); ?>
		<?php echo $form->error($model,'destructiondate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recip'); ?>
		<?php echo $form->textField($model,'recip',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'recip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dna'); ?>
		<?php echo $form->checkBox($model,'dna'); ?>
		<?php echo $form->error($model,'dna'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'bio'); ?>
		<?php echo $form->checkBox($model,'bio'); ?>
		<?php echo $form->error($model,'bio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'drug'); ?>
		<?php echo $form->checkBox($model,'drug'); ?>
		<?php echo $form->error($model,'drug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'firearm'); ?>
		<?php echo $form->checkBox($model,'firearm'); ?>
		<?php echo $form->error($model,'firearm'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'money'); ?>
		<?php echo $form->checkBox($model,'money'); ?>
		<?php echo $form->error($model,'money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'other'); ?>
		<?php echo $form->checkBox($model,'other'); ?>
		<?php echo $form->error($model,'other'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->