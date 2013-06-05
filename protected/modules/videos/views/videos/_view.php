<?php
/* @var $this VideosController */
/* @var $data Videos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('videoid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->videoid), array('view', 'id'=>$data->videoid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentid')); ?>:</b>
	<?php echo CHtml::encode($data->document->path); ?>
	<br/>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

</div>