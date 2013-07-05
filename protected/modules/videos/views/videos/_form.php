<?php
/* @var $this VideosController */
/* @var $video Videos */
/* @var $file Documents */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'videos-form',
	'enableAjaxValidation'=>false,
	'stateful'=>true, 
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($video, $file)); ?>

	<div class="row">
		<?php echo $form->labelEx($video,'title'); ?>
		<?php echo $form->textField($video,'title',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($video,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($video,'type'); ?>
		<?php echo $form->textField($video,'type',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($video,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($video,'category'); ?>
		<?php echo $form->dropDownList($video,'category',array('Video'=>'Video', 'page'=>'Html Page', 'doc'=>'Document'), array('empty' => 'Select File Type')); ?>
		<?php echo $form->error($video,'category'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($video,'poster'); ?>
		<?php echo $form->textField($video,'poster',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($video,'poster'); ?>
	</div>
	
	<div class="row">
		<?php
		echo $form->labelEx($file, 'video');
		echo $form->fileField($file, 'video');
		echo $form->error($file, 'video');
		?>
	</div>
	<br/>
	<div class="row buttons">
		<?php echo CHtml::submitButton($video->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->