<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php
		echo $form->labelEx($model, 'typeid');
		echo $form->dropDownList($model, 'typeid', CHtml::listData(NewsType::model()->findAll(), 'typeid', 'type'), array('empty' => 'Select a type')); 
		echo $form->error($model,'typeid'); 
		?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'news'); ?>
		<?php echo $form->textArea($model,'news',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'news'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->