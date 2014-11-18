<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $attorney Attorney */
/* @var $form CActiveForm */
?>

<div class="search-form">
<div class="form">
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'add-attorney-form',
	'enableAjaxValidation'=>false,
	'action'=>'changeAttorneys'
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<table>
		<tr>
			<th><?php echo $form->labelEx($attorney,'fname');?></th>
			<th><?php echo $form->labelEx($attorney,'lname');?></th>
			<th><?php echo $form->labelEx($attorney,'barid');?></th>
		</tr>

		<tr>
			<td>
			<?php echo $form->textField($attorney,'fname[]', array('required' => true)); ?>
			<?php echo $form->error($attorney,'fname[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($attorney,'lname[]', array('required' => true)); ?>
			<?php echo $form->error($attorney,'lname[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($attorney,'barid[]'); ?>
			<?php echo $form->error($attorney,'barid[]'); ?>
			</td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($attorney->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->