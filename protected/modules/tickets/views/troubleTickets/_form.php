<?php
/* @var $this TroubleTicketsController */
/* @var $ticket TroubleTickets */
/* @var $file Documents */
/* @var $form CActiveForm */

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl . '/scripts/dropzone.js');
?>

<script>
Dropzone.options.ticketsForm = {
	paramName: "file", // The name that will be used to transfer the file
	autoProcessQueue: false,
	success: function(){ window.location.href = '/tickets/troubletickets/index?status=Open';}
};
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ticketsForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'stateful'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'dropzone'),
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
					'url' => CController::createUrl('troubletickets/dynamicsubjects'),
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
				array('empty' => 'Select a subject','ajax' => 
					array(
						'type' => 'GET',
						'url' => CController::createUrl('troubletickets/dynamictips'),
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
		<div class="fallback">
			<?php echo $form->fileField($file, 'file'); ?>
			<?php echo $form->error($file, 'file'); ?>
		</div>
	</div>
	
	<div id="button" class="row buttons" style="display:none">
		<?php echo CHtml::button($ticket->isNewRecord ? 'Create' : 'Save', array('title'=>"Create",
			'onclick'=> 
				'var dz = Dropzone.forElement("#ticketsForm");
				queuedFiles = dz.getQueuedFiles();
				if((queuedFiles.length > 0))
				{
					dz.processQueue();
				}
				else
				{
					document.getElementById("ticketsForm").submit();
				}'
			)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->