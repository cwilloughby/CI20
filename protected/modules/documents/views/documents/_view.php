<?php
/* @var $this DocumentsController */
/* @var $data Documents */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->documentid), array('view', 'id'=>$data->documentid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uploader')); ?>:</b>
	<?php echo CHtml::encode($data->uploader); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documentname')); ?>:</b>
	<?php echo CHtml::encode($data->documentname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('path')); ?>:</b>
	<?php echo CHtml::encode($data->path); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uploaddate')); ?>:</b>
	<?php echo CHtml::encode($data->uploaddate); ?>
	<br />


</div>