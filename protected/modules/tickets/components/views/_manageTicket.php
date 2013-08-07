<?php
/* @var $this TroubleTicketsController */
/* @var $model ManageTicket */
/* @var $file Documents */
/* @var $form CActiveForm */
?>

<div class="form">

<h4>Manage Ticket</h4>
	
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'close-tickets-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary(array($model, $file)); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<div class="row">
		<?php
		echo $form->labelEx($file, 'attachment');
		echo $form->fileField($file, 'attachment');
		echo $form->error($file, 'attachment');
		?>
	</div>
	
	<br/>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit Comment'); ?>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		<?php echo CHtml::submitButton('Close Ticket'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->