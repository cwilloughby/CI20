<?php
/* @var $this DocTableController */
/* @var $model DocTable */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">The release date and release number (if there are any) will be automatically added to the post.</p>
	
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php 
	echo $form->errorSummary($model);
	
	echo CHtml::activeHiddenField($model, 'path');
	echo CHtml::activeHiddenField($model, 'release_num');
	echo CHtml::activeHiddenField($model, 'release_date');
	?>

	<div class="row">
		<?php echo $form->labelEx($model,'features'); ?>
		<?php echo $form->textArea($model,'features',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'features'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Post'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->