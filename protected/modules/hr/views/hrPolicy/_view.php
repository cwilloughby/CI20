<?php
/* @var $this HrPolicyController */
/* @var $data HrPolicy */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sectionid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sectionid), array('view', 'id'=>$data->sectionid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('section')); ?>:</b>
	<?php echo CHtml::encode($data->section); ?>
	<br />


</div>