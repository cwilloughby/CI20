<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $attorney Attorney */
/* @var $form CActiveForm */
?>

<div class="search-form">
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evidence-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php $this->widget('ext.jqrelcopy.JQRelcopy',array(
		'id' => 'copylink',
		'removeText' => 'Remove',
		'removeHtmlOptions' => array('style'=>'color:red'),
		'options' => array(
			'copyClass'=>'newcopy',
			'limit'=>20,
			'clearInputs'=>true,
			'excludeSelector'=>'.skipcopy',
			'append'=>CHtml::tag('span',array('class'=>'hint'),'You can remove this line'),
		)
	))?>

	<table class="evidence">
		<tr>
			<th><?php echo $form->labelEx($evidence,'exhibitlist');?></th>
			<th><?php echo $form->labelEx($evidence,'hearingtype');?></th>
			<th><?php echo $form->labelEx($evidence,'hearingdate');?></th>
			<th><?php echo $form->labelEx($evidence,'exhibitno');?></th>
			<th><?php echo $form->labelEx($evidence,'evidencename');?></th>
			<th><?php echo $form->labelEx($evidence,'comment');?></th>
		</tr>

		<tr class="filters copy">
			
			<?php echo $form->hiddenField($evidence,'caseno[]', array('required' => true, 'value'=>$summary->caseno)); ?>
			<?php echo $form->error($evidence,'caseno[]'); ?>
			
			<td>
			<?php echo $form->textField($evidence,'exhibitlist[]'); ?>
			<?php echo $form->error($evidence,'exhibitlist[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($evidence,'hearingtype[]'); ?>
			<?php echo $form->error($evidence,'hearingtype[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($evidence,'hearingdate[]'); ?>
			<?php echo $form->error($evidence,'hearingdate[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($evidence,'exhibitno[]', array('required' => true)); ?>
			<?php echo $form->error($evidence,'exhibitno[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($evidence,'evidencename[]', array('required' => true)); ?>
			<?php echo $form->error($evidence,'evidencename[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($evidence,'comment[]'); ?>
			<?php echo $form->error($evidence,'comment[]'); ?>
			</td>
		</tr>
		<tr>
			<td>
			<a id="copylink" href="#" rel=".copy">Add More Evidence</a>
			</td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($evidence->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div><!-- form -->