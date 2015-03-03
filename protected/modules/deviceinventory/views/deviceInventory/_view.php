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

	<b><?php echo CHtml::encode($data->getAttributeLabel('serial')); ?>:</b>
	<?php echo CHtml::encode($data->serial); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('warrentyenddate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->warrentyenddate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('revolvedate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->revolvedate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments')); ?>:</b>
	<?php echo CHtml::encode($data->comments); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('url')); ?>:</b>
	<?php echo CHtml::encode($data->url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('equipmenttype')); ?>:</b>
	<?php echo CHtml::encode($data->equipmenttype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('enabled')); ?>:</b>
	<?php echo CHtml::encode($data->enabled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->indate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outdate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->outdate))); ?>
	<br />
	
</div>