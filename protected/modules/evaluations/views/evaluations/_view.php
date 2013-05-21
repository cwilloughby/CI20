<?php
/* @var $this EvaluationsController */
/* @var $data Evaluations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluationdate')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode(date('g:i a m/d/Y', strtotime($data->evaluationdate))),array('view', 'id'=>$data->evaluationid)); ?>
	<br/>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('employee')); ?>:</b>
	<?php echo CHtml::encode($data->employee0->firstname . ' ' . $data->employee0->lastname); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluator')); ?>:</b>
	<?php echo CHtml::encode($data->evaluator0->firstname . ' ' . $data->evaluator0->lastname); ?>
	<br/>

</div>