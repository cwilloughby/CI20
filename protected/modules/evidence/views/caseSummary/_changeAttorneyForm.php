<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $attorney Attorney */
/* @var $form CActiveForm */
?>

<h1>Remove Attorneys</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'attorney-grid',
	'dataProvider'=>$attorney->search($summary->summaryid),
	'filter'=>$attorney,
	'columns'=>array(
		'fname',
		'lname',
		'type',
		'barid',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{delete}',
			'deleteConfirmation'=>"js:'Are you sure you want to remove this attorney from the case?'",
			'buttons'=>array(
				'delete'=>array(
					'label'=>'Remove Attorney',
					'url'=>'Yii::app()->createUrl("/evidence/casesummary/deleteAttorneyFromCase", 
						array("sid"=>' . $summary->summaryid . ', "aid"=>$data->attyid))'
				),
			),
		),
	),
));?>

<h1>Add Attorneys</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'add-attorney-form',
	'enableAjaxValidation'=>false,
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
	
	<table>
		<tr>
			<th><?php echo $form->labelEx($attorney,'fname');?></th>
			<th><?php echo $form->labelEx($attorney,'lname');?></th>
			<th><?php echo $form->labelEx($attorney,'barid');?></th>
		</tr>

		<tr class="row copy">
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
		<tr>
			<td>
			<a id="copylink" href="#" rel=".copy">Add More Attorneys To The Case</a>
			</td>
		</tr>
	</table>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($attorney->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->