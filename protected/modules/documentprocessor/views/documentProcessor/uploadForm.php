<?php
/* @var $this DocumentProcessorController */
/* @var $form CActiveForm */
/* @var $document Documents */

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
	
	<div class="row">
		<?php echo $form->fileField($document, 'file'); ?>
		<?php echo $form->error($document, 'file'); ?>
	</div>
	<br/>
	<div id="button" class="row buttons">
		<?php
		echo CHtml::submitButton("Upload");
		?>
	</div>
	
<?php $this->endWidget(); ?>
	
</div><!-- form -->
