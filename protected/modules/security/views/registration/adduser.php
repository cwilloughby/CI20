<?php
/* @var $this UserInfoController */
/* @var $model AddUserForm */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-adduser-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname'); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'middlename'); ?>
		<?php echo $form->textField($model,'middlename'); ?>
		<?php echo $form->error($model,'middlename'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname'); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phoneext'); ?>
		<?php echo $form->textField($model,'phoneext'); ?>
		<?php echo $form->error($model,'phoneext'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'hiredate'); ?>
		<?php echo $form->textField($model,'hiredate'); ?>
		<?php echo $form->error($model,'hiredate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'departmentid'); ?>
		<?php echo $form->dropDownList($model,'departmentid', $departments); ?>
		<?php echo $form->error($model,'departmentid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Roleid'); ?>
		<?php echo $form->dropDownList($model,'Roleid', $roles); ?>
		<?php echo $form->error($model,'Roleid'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->