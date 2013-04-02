<?php
/* @var $this UserInfoController */
/* @var $data UserInfo */
?>

<div class="view">

	<?php echo CHtml::link("Edit", array('update', 'id'=>$data->userid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firstname')); ?>:</b>
	<?php echo CHtml::encode($data->firstname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastname')); ?>:</b>
	<?php echo CHtml::encode($data->lastname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('middlename')); ?>:</b>
	<?php echo CHtml::encode($data->middlename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phoneext')); ?>:</b>
	<?php echo CHtml::encode($data->phoneext); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departmentid')); ?>:</b>
	<?php echo CHtml::encode($data->department->departmentname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hiredate')); ?>:</b>
	<?php echo CHtml::encode(date('m/d/Y', strtotime($data->hiredate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('active')); ?>:</b>
	<?php
	if($data->active == 1)
		echo "Yes";
	else
		echo "No";
	?>
	<br />

</div>