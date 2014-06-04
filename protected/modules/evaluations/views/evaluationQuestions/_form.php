<?php
/* @var $this EvaluationQuestionsController */
/* @var $model EvaluationQuestions */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'evaluation-questions-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->radioButtonList($model, 'type', array(1 => "1 out of 4", 2 => "1 out of 2",), 
				array(
					'separator'=>'&nbsp;',
					'labelOptions'=>array(
						'style'=>'display: inline; margin-right: 10px; font-weight: normal;'
					)
				));?>
		<?php echo $form->error($model,'type'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'question'); ?>
		<?php echo $form->textArea($model,'question'); ?>
		<?php echo $form->error($model,'question'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->