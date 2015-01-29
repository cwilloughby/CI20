<?php
/* @var $this DeviceInventoryController */
/* @var $data DeviceInventory */
?>

<div class="view">

	<h4><?php echo CHtml::link('View Item', array('view', 'id'=>$data->deviceid)); ?></h4>

	<b><?php echo CHtml::encode($data->getAttributeLabel('devicename')); ?>:</b>
	<?php echo CHtml::encode($data->devicename); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('model')); ?>:</b>
	<?php echo CHtml::encode($data->model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('servicetag')); ?>:</b>
	<?php echo CHtml::encode($data->servicetag); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('warrentyenddate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->warrentyenddate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('revolvedate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->revolvedate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('extension')); ?>:</b>
	<?php echo CHtml::encode($data->extension); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

</div>