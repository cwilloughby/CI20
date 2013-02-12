<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-info-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<table class="span-5">
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'username');
				echo $form->textField($model,'username',array('maxlength'=>41));
				echo $form->error($model,'username'); 
				?>
			</td>
		</tr>
		<tr>
			<td>
				<?php 
				echo $form->labelEx($model,'firstname');
				echo $form->textField($model,'firstname',array('maxlength'=>30));
				echo $form->error($model,'firstname'); 
				?>
			</td>
			<td>
				<?php 
				echo $form->labelEx($model,'lastname');
				echo $form->textField($model,'lastname',array('maxlength'=>40));
				echo $form->error($model,'lastname');
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'middlename');
				echo $form->textField($model,'middlename',array('maxlength'=>45));
				echo $form->error($model,'middlename'); 
				?>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'email');
				echo $form->textField($model,'email',array('maxlength'=>100));
				echo $form->error($model,'email');
				?>
			</td>
		</tr>
		<tr>
			<td style="text-align:center;">
				<?php 
				echo $form->labelEx($model,'phoneext');
				echo $form->textField($model,'phoneext');
				echo $form->error($model,'phoneext'); 
				?>
			</td>
			<td style="text-align:center;">
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
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
			</td>
		</tr>
	</table>

<?php $this->endWidget(); ?>

</div><!-- form -->