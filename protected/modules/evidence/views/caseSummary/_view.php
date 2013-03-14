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

	<b><?php echo CHtml::encode($data->getAttributeLabel('hearingdate')); ?>:</b>
	<?php echo CHtml::encode($data->hearingdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('hearingtype')); ?>:</b>
	<?php echo CHtml::encode($data->hearingtype); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('page')); ?>:</b>
	<?php echo CHtml::encode($data->page); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sentence')); ?>:</b>
	<?php echo CHtml::encode($data->sentence); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('indate')); ?>:</b>
	<?php echo CHtml::encode($data->indate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('outdate')); ?>:</b>
	<?php echo CHtml::encode($data->outdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('destructiondate')); ?>:</b>
	<?php echo CHtml::encode($data->destructiondate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recip')); ?>:</b>
	<?php echo CHtml::encode($data->recip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dna')); ?>:</b>
	<?php echo CHtml::encode($data->dna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('bio')); ?>:</b>
	<?php echo CHtml::encode($data->bio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('drug')); ?>:</b>
	<?php echo CHtml::encode($data->drug); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('firearm')); ?>:</b>
	<?php echo CHtml::encode($data->firearm); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('money')); ?>:</b>
	<?php echo CHtml::encode($data->money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('other')); ?>:</b>
	<?php echo CHtml::encode($data->other); ?>
	<br />

	*/ ?>

</div>