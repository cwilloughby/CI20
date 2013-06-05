<?php
/* @var $this EvaluationQuestionsController */
/* @var $data EvaluationQuestions */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->questionid), array('view', 'id'=>$data->questionid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departmentid')); ?>:</b>
	<?php 
	if(is_null($data->departmentid))
		echo "General Question";
	else
		echo CHtml::encode($data->department->departmentname); 
	?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question')); ?>:</b>
	<?php echo CHtml::encode($data->question); ?>
	<br />


</div>