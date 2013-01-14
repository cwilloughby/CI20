<?php
/* @var $this TroubleTicketsController */
/* @var $data TroubleTickets */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ticketid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ticketid), array('view', 'id'=>$data->ticketid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('openedby')); ?>:</b>
	<?php echo CHtml::encode($data->openedby0->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('opendate')); ?>:</b>
	<?php echo CHtml::encode(date('g:i a Y-m-d', strtotime($data->opendate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('categoryid')); ?>:</b>
	<?php echo CHtml::encode($data->category->categoryname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subjectid')); ?>:</b>
	<?php echo CHtml::encode($data->subject->subjectname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('closedbyuserid')); ?>:</b>
	<?php echo CHtml::encode((isset($data->closedbyuser->username)) 
						? $data->closedbyuser->username 
						: ""); ?>

	<br />

</div>
