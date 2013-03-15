<?php
/* @var $this DefendantController */
/* @var $data Defendant */
?>

<div class="view">
	
	<b><?php echo CHtml::encode('Name'); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->fname . ' ' . $data->lname), array('view', 'id'=>$data->defid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('oca')); ?>:</b>
	<?php echo CHtml::encode($data->oca); ?>
	<br />

</div>