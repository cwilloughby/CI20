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
	'action'=>$_SERVER['PHP_SELF'],
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
	acceptedFiles: 'application/pdf, application/msword, application/vnd.ms-excel, image/tiff, image/jpeg, image/png, image/bmp, text/plain',
	maxFilesize: 12
};
</script>