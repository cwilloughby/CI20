<?php
/* @var $this EvaluationsController */
/* @var $data Evaluations */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluationid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->evaluationid), array('view', 'id'=>$data->evaluationid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('employee')); ?>:</b>
	<?php echo CHtml::encode($data->employee); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluator')); ?>:</b>
	<?php echo CHtml::encode($data->evaluator); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evaluationdate')); ?>:</b>
	<?php echo CHtml::encode($data->evaluationdate); ?>
	<br />


</div>