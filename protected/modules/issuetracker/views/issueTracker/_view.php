<?php
/* @var $this IssueTrackerController */
/* @var $data IssueTracker */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('key')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->key), array('view', 'id'=>$data->key)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reporter')); ?>:</b>
	<?php echo CHtml::encode($data->reporter); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:</b>
	<?php echo CHtml::encode($data->summary); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assigned')); ?>:</b>
	<?php echo CHtml::encode($data->assigned); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('updated')); ?>:</b>
	<?php echo CHtml::encode($data->updated); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('originalestimate')); ?>:</b>
	<?php echo CHtml::encode($data->originalestimate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('remainingestimate')); ?>:</b>
	<?php echo CHtml::encode($data->remainingestimate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('timespent')); ?>:</b>
	<?php echo CHtml::encode($data->timespent); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resolution')); ?>:</b>
	<?php echo CHtml::encode($data->resolution); ?>
	<br />

	*/ ?>

</div>