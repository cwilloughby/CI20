<?php
/* @var $this CaseSummaryController */
/* @var $case CrtCase */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'crt-case-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary($case); ?>
	
	<table>
		<tr>
			<td>
			<?php echo $form->labelEx($case,'caseno', array('required' => true)); ?>
			<?php echo $form->textField($case,'caseno'); ?>
			<?php echo $form->error($case,'caseno'); ?>
			</td>
		</tr>

		<tr>
			<td>
			<?php echo $form->labelEx($case,'crtdiv'); ?>
			<?php echo $form->textField($case,'crtdiv'); ?>
			<?php echo $form->error($case,'crtdiv'); ?>
			</td>
		</tr>

		<tr>
			<td>
			<?php echo $form->labelEx($case,'cptno'); ?>
			<?php echo $form->textField($case,'cptno'); ?>
			<?php echo $form->error($case,'cptno'); ?>
			</td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($case->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->