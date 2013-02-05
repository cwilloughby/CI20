<?php
/* @var $this HrSectionsController */
/* @var $data HrSections */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sectionid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sectionid), array('view', 'id'=>$data->sectionid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('section')); ?>:</b>
	<?php echo CHtml::encode($data->section); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('datemade')); ?>:</b>
	<?php echo CHtml::encode($data->datemade); ?>
	<br />


</div>