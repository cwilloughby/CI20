<?php
/* @var $this AttorneyController */
/* @var $data Attorney */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('attyid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->attyid), array('view', 'id'=>$data->attyid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('barid')); ?>:</b>
	<?php echo CHtml::encode($data->barid); ?>
	<br />


</div>