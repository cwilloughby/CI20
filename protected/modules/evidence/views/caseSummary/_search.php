<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'summaryid'); ?>
		<?php echo $form->textField($model,'summaryid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'defid'); ?>
		<?php echo $form->textField($model,'defid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'caseno'); ?>
		<?php echo $form->textField($model,'caseno',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dispodate'); ?>
		<?php echo $form->textField($model,'dispodate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hearingdate'); ?>
		<?php echo $form->textField($model,'hearingdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'hearingtype'); ?>
		<?php echo $form->textField($model,'hearingtype',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'page'); ?>
		<?php echo $form->textField($model,'page',array('size'=>6,'maxlength'=>6)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'sentence'); ?>
		<?php echo $form->textField($model,'sentence',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'indate'); ?>
		<?php echo $form->textField($model,'indate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'outdate'); ?>
		<?php echo $form->textField($model,'outdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'destructiondate'); ?>
		<?php echo $form->textField($model,'destructiondate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recip'); ?>
		<?php echo $form->textField($model,'recip',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'dna'); ?>
		<?php echo $form->textField($model,'dna'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bio'); ?>
		<?php echo $form->textField($model,'bio'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'drug'); ?>
		<?php echo $form->textField($model,'drug'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'firearm'); ?>
		<?php echo $form->textField($model,'firearm'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'money'); ?>
		<?php echo $form->textField($model,'money'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'other'); ?>
		<?php echo $form->textField($model,'other'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->