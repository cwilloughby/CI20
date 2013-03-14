<?php
/* @var $this DefendantController */
/* @var $data Defendant */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('defid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->defid), array('view', 'id'=>$data->defid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oca')); ?>:</b>
	<?php echo CHtml::encode($data->oca); ?>
	<br />


</div>