<?php
/* @var $this EvidenceController */
/* @var $model Evidence */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evidence-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

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
			<th><?php echo $form->labelEx($model,'exhibitlist');?></th>
			<th><?php echo $form->labelEx($model,'caseno');?></th>
			<th><?php echo $form->labelEx($model,'hearingtype');?></th>
			<th><?php echo $form->labelEx($model,'hearingdate');?></th>
			<th><?php echo $form->labelEx($model,'exhibitno');?></th>
			<th><?php echo $form->labelEx($model,'evidencename');?></th>
			<th><?php echo $form->labelEx($model,'comment');?></th>
		</tr>

		<tr class="row copy">
			<td>
			<?php echo $form->textField($model,'exhibitlist[]', array("style"=>'width:70px')); ?>
			<?php echo $form->error($model,'exhibitlist[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($model,'caseno[]', array('required' => true, "style"=>'width:80px')); ?>
			<?php echo $form->error($model,'caseno[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($model,'hearingtype[]'); ?>
			<?php echo $form->error($model,'hearingtype[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($model,'hearingdate[]', array("style"=>'width:70px')); ?>
			<?php echo $form->error($model,'hearingdate[]'); ?>
			</td>
			
			<td>
			<?php echo $form->textField($model,'exhibitno[]', array('required' => true)); ?>
			<?php echo $form->error($model,'exhibitno[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($model,'evidencename[]', array('required' => true)); ?>
			<?php echo $form->error($model,'evidencename[]'); ?>
			</td>
			<td>
			<?php echo $form->textField($model,'comment[]'); ?>
			<?php echo $form->error($model,'comment[]'); ?>
			</td>
		</tr>
	</table>
	<a id="copylink" href="#" rel=".copy">Add More Evidence</a>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->