<?php
/* @var $this RegistrationController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Register';

$this->breadcrumbs=array(
	'Login'=>array('/security/login/loginform'),
	'Register',
);
?>

<h1>Register</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-register-form',
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
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname'); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'middlename'); ?>
		<?php echo $form->textField($model,'middlename'); ?>
		<?php echo $form->error($model,'middlename'); ?>
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
		<?php echo $form->labelEx($model,'departmentid'); ?>
		<?php echo $form->dropDownList($model,'departmentid', $departments); ?>
		<?php echo $form->error($model,'departmentid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'hiredate'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
			array(
				'model' => $model,
				'attribute' => 'hiredate',
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy', 
					'defaultDate' => $model->hiredate,
					'changeYear' => true,
					'changeMonth' => true,
				),
			));
		?>
		<?php echo $form->error($model,'hiredate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Register'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->