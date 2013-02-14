<?php
/* @var $this RegistrationController */
/* @var $model RegisterForm */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Login'=>array('/security/login/login'),
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
	
	<table class="span-5">
		<tr>
			<td>
				<?php echo $form->labelEx($model,'firstname'); ?>
				<?php echo $form->textField($model,'firstname'); ?>
				<?php echo $form->error($model,'firstname'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'lastname'); ?>
				<?php echo $form->textField($model,'lastname'); ?>
				<?php echo $form->error($model,'lastname'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php echo $form->labelEx($model,'middlename'); ?>
				<?php echo $form->textField($model,'middlename'); ?>
				<?php echo $form->error($model,'middlename'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php echo $form->labelEx($model,'email'); ?>
				<?php echo $form->textField($model,'email', array('style'=>'width:100%')); ?>
				<?php echo $form->error($model,'email'); ?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo $form->labelEx($model,'phoneext'); ?>
				<?php echo $form->textField($model,'phoneext'); ?>
				<?php echo $form->error($model,'phoneext'); ?>
			</td>
			<td>
				<?php echo $form->labelEx($model,'departmentid'); ?>
				<?php echo $form->dropDownList($model,'departmentid', $departments); ?>
				<?php echo $form->error($model,'departmentid'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php echo $form->labelEx($model,'hiredate'); ?>
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', 
					array(
						'model' => $model,
						'attribute' => 'hiredate',
						'options' => array(
							'showAnim' => 'fold',
							'dateFormat' => 'yy-mm-dd', 
							'defaultDate' => $model->hiredate,
							'changeYear' => true,
							'changeMonth' => true,
						),
					));
				?>
				<?php echo $form->error($model,'hiredate'); ?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php echo CHtml::submitButton('Register'); ?>
			</td>
		</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->