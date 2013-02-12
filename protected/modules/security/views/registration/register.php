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
				<?php 
				echo $form->labelEx($model,'firstname');
				echo $form->textField($model,'firstname');
				echo $form->error($model,'firstname');
				?>
			</td>
			<td>
				<?php 
				echo $form->labelEx($model,'lastname');
				echo $form->textField($model,'lastname');
				echo $form->error($model,'lastname'); 
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'middlename');
				echo $form->textField($model,'middlename');
				echo $form->error($model,'middlename'); 
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'email');
				echo $form->textField($model,'email', array('style'=>'width:100%'));
				echo $form->error($model,'email'); 
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php 
				echo $form->labelEx($model,'phoneext');
				echo $form->textField($model,'phoneext');
				echo $form->error($model,'phoneext'); 
				?>
			</td>
			<td>
				<?php 
				echo $form->labelEx($model,'departmentid');
				echo $form->dropDownList($model,'departmentid', $departments);
				echo $form->error($model,'departmentid'); 
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'hiredate');
				$this->widget('zii.widgets.jui.CJuiDatePicker', 
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
				echo $form->error($model,'hiredate'); 
				?>
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