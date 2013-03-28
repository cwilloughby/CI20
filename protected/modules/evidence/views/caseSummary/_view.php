<?php
/* @var $this CaseSummaryController */
/* @var $data CaseSummary */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('caseno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->caseno), array('view', 'id'=>$data->summaryid)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('defid')); ?>:</b>
	<?php echo CHtml::encode($data->def->fname . ' ' . $data->def->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('location')); ?>:</b>
	<?php echo CHtml::encode($data->location); ?>
	<br />

</div>