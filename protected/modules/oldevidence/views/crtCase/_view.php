<?php
/* @var $this CrtCaseController */
/* @var $data CrtCase */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('caseno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->caseno), array('view', 'id'=>$data->caseno)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('crtdiv')); ?>:</b>
	<?php echo CHtml::encode($data->crtdiv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cptno')); ?>:</b>
	<?php echo CHtml::encode($data->cptno); ?>
	<br />

</div>