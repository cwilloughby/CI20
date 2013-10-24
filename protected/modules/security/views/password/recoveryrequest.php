<?php
/* @var $this PasswordController */
/* @var $model UserInfo */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Recover Password';

$this->breadcrumbs=array(
	'Login'=>array('/security/login/loginform'),
	'Password Recovery',
);
?>

<h1>Password Recovery</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-recoveryrequest-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->