<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trouble-tickets-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($ticket, $file)); ?>
	
	<div class="row">
		<?php
		echo $form->labelEx($ticket, 'categoryid');
		echo $form->dropDownList($ticket, 'categoryid', CHtml::listData(TicketCategories::model()->findAll(), 'categoryid', 'categoryname'), 
			array('empty' => 'Select a category','ajax' => 
				array(
					'type' => 'POST',
					'url' => CController::createUrl('troubletickets/dynamicsubjects'),
					'datatype'=>'json',
					'data' => array('categoryid'=>'js:this.value'),
					'update' => '#' . CHtml::activeId($ticket, 'subjectid'),
				),
			)
		);
		echo $form->error($ticket, 'categoryid');
		?>
	</div>
	
	<div class="row">
		<?php 
		echo $form->labelEx($ticket, 'subjectid');
		echo $form->dropDownList($ticket, 'subjectid', array(), 
			array('empty' => 'Select a subject','style'=>'border:0px','ajax' => 
				array(
					'type' => 'POST',
					'url' => CController::createUrl('troubletickets/dynamictips'),
					'datatype'=>'json',
					'data' => array('subjectid'=>'js:this.value'),
					'update' => '#dependant',
				)
			)
		);
		echo $form->error($ticket, 'subjectid'); 
		?>
	</div>
	
	<div id="dependant">

	</div>
	
	<div class="row">
		<?php 
		echo $form->labelEx($ticket,'description');
		echo $form->textArea($ticket,'description',array('rows'=>6, 'cols'=>50));
		echo $form->error($ticket,'description'); 
		?>
	</div>

	<div class="row">
		<?php
		echo $form->labelEx($file, 'attachment');
		echo $form->fileField($file, 'attachment');
		echo $form->error($file, 'attachment');
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($ticket->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->