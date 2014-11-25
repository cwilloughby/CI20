<?php
/* @var $this DocumentUploadWidget */
/* @var $form CActiveForm */

$cs = Yii::app()->getClientScript();
$cs->registerScriptFile(Yii::app()->baseUrl . '/scripts/dropzone.js');
?>

<h3>Upload Files</h3>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'uploadForm',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'stateful'=>true, 
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
	
	<div class="fallback">
		<?php echo $form->fileField($document, 'file'); ?>
		<?php echo $form->error($document, 'file'); ?>
	</div>

<?php $this->endWidget(); ?>
	
</div><!-- form -->
