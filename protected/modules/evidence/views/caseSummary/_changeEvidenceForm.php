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

	<?php echo $form->errorSummary($evidence); ?>

	<?php $this->widget('ext.jqrelcopy.JQRelcopy',array(
		//the id of the 'Copy' link in the view, see below.
		'id' => 'copylink',
		 //leave empty to disable removing
		'removeText' => 'Remove',
		//htmlOptions of the remove link
		'removeHtmlOptions' => array('style'=>'color:red'),
		//options of the plugin, see http://www.andresvidal.com/labs/relcopy.html
		'options' => array(
			//A class to attach to each copy
			'copyClass'=>'newcopy',
			// The number of allowed copies. Default: 0 is unlimited
			'limit'=>100,
			//Option to clear each copies text input fields or textarea
			'clearInputs'=>true,
			//A jQuery selector used to exclude an element and its children
			'excludeSelector'=>'.skipcopy',
			//Additional HTML to attach at the end of each copy.
			'append'=>CHtml::tag('span',array('class'=>'hint'),'You can remove this line'),
		)
	))?>
 
	<table>
		<tr>
			<th><?php echo $form->labelEx($evidence,'exhibitlist');?></th>
			<th><?php echo $form->labelEx($evidence,'hearingtype');?></th>
			<th><?php echo $form->labelEx($evidence,'hearingdate');?></th>
			<th><?php echo $form->labelEx($evidence,'exhibitno');?></th>
			<th><?php echo $form->labelEx($evidence,'evidencename');?></th>
			<th><?php echo $form->labelEx($evidence,'comment');?></th>
		</tr>

		<tr class="row copy">
			
			<?php echo $form->hiddenField($evidence,'caseno[]', array('required' => true, 'value'=>$summary->caseno)); ?>
			<?php echo $form->error($evidence,'caseno[]'); ?>
			
			<td>
			<?php echo $form->textField($evidence,'exhibitlist[]', array("style"=>'width:70px')); ?>
			<?php echo $form->error($evidence,'exhibitlist[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($evidence,'hearingtype[]'); ?>
			<?php echo $form->error($evidence,'hearingtype[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($evidence,'hearingdate[]', array("style"=>'width:70px')); ?>
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
	</table>
	<a id="copylink" href="#" rel=".copy">Add More Evidence</a>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($evidence->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div>
</div><!-- form -->