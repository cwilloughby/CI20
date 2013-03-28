<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<?php echo CHtml::link('View News', array('view', 'id'=>$data->newsid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('typeid')); ?>:</b>
	<?php echo CHtml::encode($data->type->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('postedby')); ?>:</b>
	<?php echo CHtml::encode($data->postedby0->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->date))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('news')); ?>:</b>
	<?php echo CHtml::encode($data->news); ?>
	<br />


</div>