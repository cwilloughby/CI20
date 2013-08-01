<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="view">

	<h4><?php echo CHtml::link('View News', array('view', 'id'=>$data->newsid)); ?></h4>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('typeid')); ?>:
	<?php echo CHtml::encode($data->type->type); ?>
	</h5>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('postedby')); ?>:
	<?php echo CHtml::encode($data->postedby0->username); ?>
	</h5>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:
	<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->date))); ?>
	</h5>

	<b><?php echo CHtml::encode($data->getAttributeLabel('news')); ?>:</b>
	<?php echo nl2br($data->news); ?>
	<br />


</div>