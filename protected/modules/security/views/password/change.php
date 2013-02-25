<?php
/* @var $this PasswordController */
/* @var $model UserInfo */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Change Password';
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-change-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo CHtml::activeLabel($model,'oldpassword', array('required' => true)); ?>
		<?php echo $form->passwordField($model,'oldpassword'); ?>
		<?php echo $form->error($model,'oldpassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
	
	<div class="row">
		<?php echo CHtml::activeLabel($model,'password_repeat', array('required' => true)); ?>
		<?php echo $form->passwordField($model,'password_repeat'); ?>
		<?php echo $form->error($model,'password_repeat'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Change Password'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->