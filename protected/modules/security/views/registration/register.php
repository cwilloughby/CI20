<?php
/* @var $this RegistrationController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-register-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'FirstName'); ?>
		<?php echo $form->textField($model,'FirstName'); ?>
		<?php echo $form->error($model,'FirstName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'LastName'); ?>
		<?php echo $form->textField($model,'LastName'); ?>
		<?php echo $form->error($model,'LastName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MiddleName'); ?>
		<?php echo $form->textField($model,'MiddleName'); ?>
		<?php echo $form->error($model,'MiddleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email'); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PhoneExt'); ?>
		<?php echo $form->textField($model,'PhoneExt'); ?>
		<?php echo $form->error($model,'PhoneExt'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'DepartmentID'); ?>
		<?php echo $form->dropDownList($model,'DepartmentID', $departments); ?>
		<?php echo $form->error($model,'DepartmentID'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'HireDate'); ?>
		<?php echo $form->textField($model,'HireDate'); ?>
		<?php echo $form->error($model,'HireDate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->