<?php
/* @var $this DocumentUploadWidget */
/* @var $form CActiveForm */

$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->baseUrl . '/css/dropzone.css');
$cs->registerScriptFile(Yii::app()->baseUrl . '/scripts/dropzone.js');
?>

<h3>Upload File</h3>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'uploadForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'stateful'=>true, 
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'dropzone'),
)); ?>
	
	<div class="fallback">
		<?php echo $form->fileField($document, 'file'); ?>
		<?php echo $form->error($document, 'file'); ?>
	</div>

<?php $this->endWidget(); ?>
	
</div><!-- form -->

<script>
Dropzone.options.uploadForm = {
	acceptedFiles: 'application/pdf, \n\
					application/msword,\n\
					application/vnd.openxmlformats-officedocument.wordprocessingml.document, \n\
					application/vnd.ms-excel, \n\
					image/tiff, \n\
					image/jpeg, \n\
					image/png, \n\
					image/bmp, \n\
					text/plain',
	maxFilesize: 12,
	init: function() {
		this.on("error", function(file, message) {
			file.previewElement.classList.add("dz-error");
			if(message.length < 100)
				return file.previewElement.querySelector("[data-dz-errormessage]").textContent = message;
			else
				return file.previewElement.querySelector("[data-dz-errormessage]").textContent = "Upload Failed!";
		});
	}
};
</script>