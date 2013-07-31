<?php
/* @var $this LogController */
/* @var $data Log */
?>

<div class="view">

	<b><?php echo CHtml::link(CHtml::encode('View Log ' . $data->eventid), array('view', 'id'=>$data->eventid)); ?></b>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tablename')); ?>:</b>
	<?php echo CHtml::encode($data->tablename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tablerow')); ?>:</b>
	<?php echo CHtml::encode($data->tablerow); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('eventdate')); ?>:</b>
	<?php echo CHtml::encode(date('g:i:s a m/d/Y', strtotime($data->eventdate))); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('event')); ?>:</b>
	<?php echo CHtml::encode($data->event); ?>
	<br />

</div>