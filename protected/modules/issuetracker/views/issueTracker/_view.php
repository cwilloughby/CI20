<?php
/* @var $this IssueTrackerController */
/* @var $data IssueTracker */
?>

<div class="view">

	<h4><?php echo CHtml::link(CHtml::encode('View Issue ' . $data->key), array('view', 'id'=>$data->id)); ?></h4>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:
	<?php echo CHtml::encode($data->type); ?>
	</h5>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:
	<?php echo CHtml::encode($data->created); ?>
	</h5>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('reporter')); ?>:
	<?php echo CHtml::encode($data->reporter); ?>
	</h5>
	
	<h5><?php echo CHtml::encode($data->getAttributeLabel('assigned')); ?>:
	<?php echo CHtml::encode($data->assigned); ?>
	</h5>
	
	<h5><?php echo CHtml::encode($data->getAttributeLabel('summary')); ?>:
	<?php echo CHtml::encode($data->summary); ?>
	</h5>

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo nl2br($data->description); ?>
	<br />

</div>