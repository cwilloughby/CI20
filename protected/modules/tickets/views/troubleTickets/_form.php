<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trouble-tickets-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php /*echo $form->labelEx($model,'categoryid'); */?>
		<?php /*echo $form->dropDownList($model,'categoryid', $categories); */?>
		<?php /*echo $form->error($model,'categoryid'); */?>
	</div>

	<div class="row">
		<?php /*echo $form->labelEx($model,'subjectid'); */?>
		<?php /*echo $form->dropDownList($model,'subjectid', $subjects); */?>
		<?php /*echo $form->error($model,'subjectid'); */?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'categoryid'); ?>
		<?php
		echo $form->dropDownList($model, 'categoryid', CHtml::listData(TicketCategories::model()->findAll(), 'categoryid', 'categoryname'), 
			array('empty' => 'Select Category','ajax' => 
				array(
					'type' => 'POST',
					'url' => CController::createUrl('troubletickets/dynamicsubjects'),
					'update' => '#subjectid'
				)
			)
		);
		?>
		<?php echo $form->error($model, 'categoryid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model, 'subjectid'); ?>
		<?php echo CHtml::dropDownList('subjectid', array(), array('prompt'=>'Select Subject')); ?>
		<?php echo $form->error($model, 'subjectid'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->