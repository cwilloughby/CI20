<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('newsid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->newsid), array('view', 'id'=>$data->newsid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typeid')); ?>:</b>
	<?php echo CHtml::encode($data->typeid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postedby')); ?>:</b>
	<?php echo CHtml::encode($data->postedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news')); ?>:</b>
	<?php echo CHtml::encode($data->news); ?>
	<br />


</div>