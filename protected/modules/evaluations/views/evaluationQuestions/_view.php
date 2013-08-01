<?php
/* @var $this EvaluationQuestionsController */
/* @var $data EvaluationQuestions */
?>

<div class="view">

	<h4><?php echo CHtml::link(CHtml::encode("View Question " . $data->questionid), array('view', 'id'=>$data->questionid)); ?></h4>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('departmentid')); ?>:
	<?php 
	if(is_null($data->departmentid))
		echo "General Question";
	else
		echo CHtml::encode($data->department->departmentname); 
	?>
	</h5>

	<b><?php echo CHtml::encode($data->getAttributeLabel('question')); ?>:</b>
	<?php echo CHtml::encode($data->question); ?>
	<br />

</div>