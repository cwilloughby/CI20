<?php
/* @var $this TroubleTicketsController */
/* @var $model ManageTicket */
/* @var $file Documents */
/* @var $form CActiveForm */

//$cs = Yii::app()->getClientScript();
//$cs->registerScriptFile(Yii::app()->baseUrl . '/scripts/dropzone.js');
?>

<div class="form">
	
<h4>Manage Ticket</h4>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'manageTicketForm',
	'stateful'=>true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'/*, 'class' => 'dropzone'*/),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>
	
	<?php echo $form->errorSummary(array($model, $file)); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->fileField($file, 'file'); ?>
		<?php echo $form->error($file, 'file'); ?>
	</div>
	
	<br/>
	
	<div id="button" class="row buttons">
		<?php 
		echo CHtml::submitButton('Submit Comment');
		/*
		echo CHtml::button('Submit Comment', array('name'=>"comment",
			'onclick'=> 'mySubmit("comment");'
		));
		*/
		?>
		&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
		<?php 
		echo CHtml::submitButton('Close Ticket');
		/*
		echo CHtml::button('Close Ticket', array('name'=>"close",
			'onclick'=> 'mySubmit("close");'
		));
		*/ 
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
/*
Yii::app()->clientScript->registerScript('manageDropScript', "
	Dropzone.options.manageTicketForm = {
		paramName: 'file', // The name that will be used to transfer the file
		autoProcessQueue: false,
		uploadMultiple: true,
		parallelUploads: 10,
		maxFilesize: 12,
		success: function(){ window.location.reload();}
	};
	
	function mySubmit(type)
	{
		var dz = Dropzone.forElement('#manageTicketForm');
		queuedFiles = dz.getQueuedFiles();
		var hidden = document.createElement('input');
		hidden.type = 'hidden';
		hidden.name = 'submittype';
		hidden.value = type;
		var f = document.getElementById('manageTicketForm');
		f.appendChild(hidden);

		if((queuedFiles.length > 0))
		{
			dz.processQueue();
		}
		else
		{
			f.submit();
		}
	};
", CClientScript::POS_END);
*/
?>