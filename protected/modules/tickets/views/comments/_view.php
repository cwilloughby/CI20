<?php
/* @var $this CommentsController */
/* @var $data Comments */
?>

<div class="view">

	<h4><?php echo  CHtml::link(CHtml::encode('View Comment ' . $data->commentid), array('view', 'id'=>$data->commentid)); ?></h4>

	<h5><?php echo CHtml::encode($data->getAttributeLabel('createdby')); ?>:
	<?php echo CHtml::encode($data->createdby0->username); ?>
	</h5>
	
	<h5><?php echo CHtml::encode($data->getAttributeLabel('datecreated')); ?>:
	<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->datecreated))); ?>
	</h5>

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo nl2br($data->content); ?>
	<br />
	
</div>