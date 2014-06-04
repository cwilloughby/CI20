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

		<?php 
		echo $form->errorSummary($model); 

		echo $form->hiddenField($model,'evaluationid', array('value' => $data->evaluationid));
		echo $form->hiddenField($model,'questionid', array('value' => $data->questionid));
		?>

		<div class="row">
			<?php
			// If the question type is 1, use for radio buttons.
			if($data->question->type == 1)
			{
				echo $form->labelEx($model,'score');
				echo $form->radioButtonList($model, 'score', array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 'N/A' => 'N/A'), 
						array(
							'separator'=>'&nbsp;',
							'labelOptions'=>array(
								'style'=>'display: inline; margin-right: 10px; font-weight: normal;'
							)
						));
				echo $form->error($model,'score');
			}
			// Otherwise use two radio buttons.
			else
			{
				echo $form->labelEx($model,'score');
				echo $form->radioButtonList($model, 'score', array(0 => "Unacceptable", 1 => "Acceptable",), 
						array(
							'separator'=>'&nbsp;',
							'labelOptions'=>array(
								'style'=>'display: inline; margin-right: 10px; font-weight: normal;'
							)
						));
				echo $form->error($model,'score');
			}
			?>
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