<?php
/* @var $this VideosController */
/* @var $video Videos */
/* @var $file Documents */
/* @var $form CActiveForm */

$cs = Yii::app()->getClientScript();
$cs->registerCssFile(Yii::app()->baseUrl . '/css/dropzone.css');
$cs->registerScriptFile(Yii::app()->baseUrl . '/scripts/dropzone.js');
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'videosForm',
	'enableAjaxValidation'=>false,
	'stateful'=>true, 
	'htmlOptions' => array('enctype' => 'multipart/form-data', 'class' => 'dropzone'),
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
		<div class="fallback">
			<?php
			echo $form->fileField($file, 'video');
			echo $form->error($file, 'video');
			?>
		</div>
	</div>
	
	<div id="button" class="row buttons">
		<?php echo CHtml::button($video->isNewRecord ? 'Create' : 'Save', array('title'=>"Create",
			'onclick'=> 'VideosSubmit()'
		)); ?>
	</div>
	<br/><br/>
<?php $this->endWidget(); ?>

</div><!-- form -->

<?php
Yii::app()->clientScript->registerScript('VideosScript', "
	Dropzone.options.videosForm = {
		acceptedFiles: 'application/pdf, text/html, image/png, video/mp4',
		paramName: 'file', // The name that will be used to transfer the file
		autoProcessQueue: false,
		uploadMultiple: false,
		maxFilesize: 12,
		success: function(){ window.location.href = '/videos/videos/index';},
		init: function() {
			this.on('error', function(file, message) {
				file.previewElement.classList.add('dz-error');
				if(message.length < 100)
					return file.previewElement.querySelector('[data-dz-errormessage]').textContent = message;
				else
					return file.previewElement.querySelector('[data-dz-errormessage]').textContent = 'Upload Failed!';
			});
		}
	};
	
	function VideosSubmit()
	{
		var dz = Dropzone.forElement('#videosForm');
		queuedFiles = dz.getQueuedFiles();
		if((queuedFiles.length > 0))
		{
			dz.processQueue();
		}
	};
", CClientScript::POS_END);
?>