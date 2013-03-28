<?php
/* @var $this TimeLogController */
/* @var $data TimeLog */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('computername')); ?>:</b>
	<?php echo CHtml::encode($data->computername); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eventtype')); ?>:</b>
	<?php echo CHtml::encode($data->eventtype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eventtime')); ?>:</b>
	<?php echo CHtml::encode(date('g:i a', strtotime($data->eventtime))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('eventdate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->eventdate))); ?>
	<br />


</div>