<?php
/* @var $this CaseSummaryController */
/* @var $defendant Defendant */
/* @var $form CActiveForm */

/*
 * This form allows the user to change the defendant of an existing case summary.
 */
?>

<div class="form">
	
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'case-summary-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	<p class="note">If the defendant is a company and not a person,
		just put the company's name in for the last name and leave the first name and oca blank.</p>
	
	<?php echo $form->errorSummary($defendant); ?>
	
	<table>
		<tr>
			<td>
			<?php echo $form->labelEx($defendant,'fname'); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $defendant,
				'attribute' => 'fname',
				'sourceUrl' => Yii::app()->createUrl('evidence/defendant/DefendantFirstNameLookup'),
				'options' => array(
					'minLength' => '1',
				),
			));
			?>
			<?php echo $form->error($defendant,'fname'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($defendant,'lname', array('required' => true)); ?>
			<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
				'model' => $defendant,
				'attribute' => 'lname',
				'sourceUrl' => Yii::app()->createUrl('evidence/defendant/DefendantLastNameLookup'),
				'options' => array(
					'minLength' => '1',
				),
			));?>
			<?php echo $form->error($defendant,'lname'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php echo $form->labelEx($defendant,'oca'); ?>
			<?php echo $form->textField($defendant,'oca'); ?>
			<?php echo $form->error($defendant,'oca'); ?>
			</td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($defendant->isNewRecord ? 'Create' : 'Save'); ?>
	</div>
	
	<?php $this->endWidget(); ?>

</div><!-- form -->