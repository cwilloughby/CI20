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
		<?php
		echo $form->labelEx($model, 'categoryid');
		echo $form->dropDownList($model, 'categoryid', CHtml::listData(TicketCategories::model()->findAll(), 'categoryid', 'categoryname'), 
			array('empty' => 'Select a category','ajax' => 
				array(
					'type' => 'POST',
					'url' => CController::createUrl('troubletickets/dynamicsubjects'),
					'datatype'=>'json',
					'data' => array('categoryid'=>'js:this.value'),
					'update' => '#' . CHtml::activeId($model, 'subjectid'),
				),
			)
		);
		echo $form->error($model, 'categoryid');
		?>
	</div>
	
	<div class="row">
		<?php 
		echo $form->labelEx($model, 'subjectid');
		echo $form->dropDownList($model, 'subjectid', array(), 
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
		echo $form->error($model, 'subjectid'); 
		?>
	</div>
	
	<div id="dependant">

	</div>
	
	<div class="row">
		<?php 
		echo $form->labelEx($model,'description');
		echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50));
		echo $form->error($model,'description'); 
		?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
