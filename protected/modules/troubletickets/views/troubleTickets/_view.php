<?php
/* @var $this TroubleTicketsController */
/* @var $data TroubleTickets */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticketid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ticketid), array('view', 'id'=>$data->ticketid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openedby')); ?>:</b>
	<?php echo CHtml::encode($data->openedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opendate')); ?>:</b>
	<?php echo CHtml::encode($data->opendate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoryid')); ?>:</b>
	<?php echo CHtml::encode($data->categoryid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subjectid')); ?>:</b>
	<?php echo CHtml::encode($data->subjectid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('closedbyuserid')); ?>:</b>
	<?php echo CHtml::encode($data->closedbyuserid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('closedate')); ?>:</b>
	<?php echo CHtml::encode($data->closedate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resolution')); ?>:</b>
	<?php echo CHtml::encode($data->resolution); ?>
	<br />

	*/ ?>

</div>