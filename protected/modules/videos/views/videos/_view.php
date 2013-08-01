<?php
/* @var $this VideosController */
/* @var $data Videos */
?>

<div class="view">

	<h4><?php echo CHtml::link(CHtml::encode('View Training Resource ' . $data->videoid), array('view', 'id'=>$data->videoid)); ?></h4>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:
	<?php echo CHtml::encode($data->title); ?>
	</h5>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('documentid')); ?>:</b>
	<?php echo CHtml::encode($data->document->path); ?>
	<br/>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('poster')); ?>:</b>
	<?php echo CHtml::encode($data->poster); ?>
	<br />
</div>