<?php
/* @var $this EvaluationsController */
/* @var $data EvaluationAnswers */
?>

<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('question')); ?>:</b>
	<?php echo CHtml::encode($data->question->question); ?>
	<br/>
	
	<?php $model = $this->loadAnswerModel($data->evaluationid, $data->questionid);?>
	<br/>
	
	<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'evaluation-answers-form',
		'enableAjaxValidation'=>false,
	)); ?>

		<p class="note">Fields with <span class="required">*</span> are required.</p>

		<?php 
		echo $form->errorSummary($model); 

		echo $form->hiddenField($model,'evaluationid', array('value' => $data->evaluationid));
		echo $form->hiddenField($model,'questionid', array('value' => $data->questionid));
		?>

		<div class="row">
			<?php echo $form->labelEx($model,'score'); ?>
			<?php echo $form->radioButtonList($model, 'score', array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5), 
					array(
						'separator'=>'&nbsp;',
						'labelOptions'=>array(
							'style'=>'display: inline; margin-right: 10px; font-weight: normal;'
						)
					)); ?>
			<?php echo $form->error($model,'score'); ?>
		</div>

		<div class="row">
			<?php echo $form->labelEx($model,'comments'); ?>
			<?php echo $form->textArea($model,'comments'); ?>
			<?php echo $form->error($model,'comments'); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		</div>

	<?php $this->endWidget(); ?>

	</div><!-- form -->
</div>