<?php
/* @var $this EvaluationsController */
/* @var $data Evaluations */
?>

<div class="view">

	<h4><?php echo CHtml::link('View Evaluation', array('view', 'id'=>$data->evaluationid)); ?></h4>
	
	<h5><?php echo CHtml::encode($data->getAttributeLabel('evaluationdate')); ?>:
	<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->evaluationdate))); ?>
	</h5>
	
	<h5><?php echo CHtml::encode($data->getAttributeLabel('employee')); ?>:
	<?php echo CHtml::encode($data->employee0->firstname . ' ' . $data->employee0->lastname); ?>
	</h5>
	
	<h5><?php echo CHtml::encode($data->getAttributeLabel('evaluator')); ?>:
	<?php echo CHtml::encode($data->evaluator0->firstname . ' ' . $data->evaluator0->lastname); ?>
	</h5>

</div>