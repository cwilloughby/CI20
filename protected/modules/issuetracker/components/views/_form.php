<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'issue-tracker-search-form',
	'enableAjaxValidation'=>false,
	'method'=>'get',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'search'); ?>
		<?php echo $form->textField($model,'search'); ?>
		<?php echo CHtml::submitButton('Search'); ?>
		<?php echo $form->error($model,'search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->