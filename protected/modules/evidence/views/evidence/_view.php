<?php
/* @var $this EvidenceController */
/* @var $data Evidence */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('exhibitno')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->exhibitno), array('view', 'id'=>$data->evidenceid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('caseno')); ?>:</b>
	<?php echo CHtml::encode($data->caseno); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('evidencename')); ?>:</b>
	<?php echo CHtml::encode($data->evidencename); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dateadded')); ?>:</b>
	<?php echo ((int)$data->dateadded)?CHtml::encode(date("m/d/Y", strtotime($data->dateadded))):"N/A"; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('exhibitlist')); ?>:</b>
	<?php echo CHtml::encode($data->exhibitlist); ?>
	<br />


</div>