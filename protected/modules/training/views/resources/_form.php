<?php
/* @var $this ResourcesController */
/* @var $resource TrainingResources */
/* @var $document Documents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'videosForm',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($resource, $document)); ?>

	<div class="row">
		<?php echo $form->labelEx($resource,'title'); ?>
		<?php echo $form->textField($resource,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($resource,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($resource,'type'); ?>
		<?php echo $form->textField($resource,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($resource,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($resource,'category'); ?>
		<?php echo $form->dropDownList($resource,'category',array('Video'=>'Video', 'page'=>'Html Page', 'doc'=>'Document'), array('empty' => 'Select File Type')); ?>
		<?php echo $form->error($resource,'category'); ?>
	</div>
	
	<div class="row">
		<?php
		echo "Poster <span class='required'>*</span> (Note: 150 x 100 resolution is recommended, but not required.)<br/>";
		echo $form->fileField($resource, 'poster');
		echo $form->error($resource, 'poster');
		?>
	</div>
	
	<div class="row">
		<?php
		echo "File <span class='required'>*</span><br/>";
		echo $form->fileField($document, 'file');
		echo $form->error($document, 'file');
		?>
	</div>
	
	<br/>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($resource->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
