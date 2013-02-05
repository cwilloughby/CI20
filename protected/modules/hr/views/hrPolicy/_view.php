<?php
/* @var $this HrPolicyController */
/* @var $data HrPolicy */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('policyid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->policyid), array('view', 'id'=>$data->policyid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('policy')); ?>:</b>
	<?php echo CHtml::encode($data->policy); ?>
	<br />


</div>