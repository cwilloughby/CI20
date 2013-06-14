<?php
/* @var $this EvaluationsController */
/* @var $data EvaluationAnswers */
?>
<br/>
<div class="view">
	<b><?php echo CHtml::encode($data->getAttributeLabel('question')); ?>:</b>
	<?php echo CHtml::encode($data->question->question); ?>
	<br/>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br/>

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br/>
</div>
