<?php
/* @var $this DocumentsProcessorController */
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
	<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->uploaddate))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ext')); ?>:</b>
	<?php echo CHtml::encode($data->ext); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('prefix')); ?>:</b>
	<?php echo CHtml::encode($data->prefix); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifiedby')); ?>:</b>
	<?php echo CHtml::encode($data->modifiedby); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('modifieddate')); ?>:</b>
	<?php echo CHtml::encode($data->modifieddate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('signed')); ?>:</b>
	<?php echo CHtml::encode($data->signed); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('disabled')); ?>:</b>
	<?php echo CHtml::encode($data->disabled); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('shareable')); ?>:</b>
	<?php echo CHtml::encode($data->shareable); ?>
	<br />

	*/ ?>

</div>