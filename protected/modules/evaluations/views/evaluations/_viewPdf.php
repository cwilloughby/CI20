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
	<?php
	if($data->question->type == 1)
	{
		echo CHtml::encode($data->score) . "<br/>";
	}
	else if($data->question->type == 2)
	{
		if($data->score == 1)
			echo "Acceptable<br/>";
		else 
			echo "Unacceptable<br/>";
	}
	?>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br/>
</div>
