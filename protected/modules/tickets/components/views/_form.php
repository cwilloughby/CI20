<?php
/* @var $this TroubleTicketsController */
/* @var $ticket TroubleTickets */
/* @var $file Documents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'trouble-tickets-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'stateful'=>true, 
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
					'type' => 'GET',
					'url' => $this->controller->createUrl('/tickets/troubletickets/dynamicsubjects'),
					'datatype'=>'json',
					'data' => array('categoryid'=>'js:this.value'),
					'update' => '#' . CHtml::activeId($ticket, 'subjectid'),
					'beforeSend' => 'function(){
						$("#test").hide();
						$("#dependant").hide();
						$("#button").hide();
					}',
					'complete' => 'function(){
						$("#test").show();
					}',
				),
			)
		);
		echo $form->error($ticket, 'categoryid');
		?>
	</div>
	<div id="test" style="display:none">
		<div class="row">
			<?php 
			echo $form->labelEx($ticket, 'subjectid');
			echo $form->dropDownList($ticket, 'subjectid', array(), 
				array('empty' => 'Select a subject','style'=>'border:0px','ajax' => 
					array(
						'type' => 'GET',
						'url' => $this->controller->createUrl('/tickets/troubletickets/dynamictips'),
						'datatype'=>'json',
						'data' => array('subjectid'=>'js:this.value'),
						'update' => '#dependant',
						'beforeSend' => 'function(){
							$("#dependant").hide();
							$("#button").hide();
						}',
						'complete' => 'function(){
							$("#dependant").show();
							$("#button").show();
						}',
					)
				)
			);
			echo $form->error($ticket, 'subjectid'); 
			?>
		</div>
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
	
	<div id="button" class="row buttons" style="display:none">
		<?php echo CHtml::submitButton($ticket->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->