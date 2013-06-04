<?php
/* @var $this TrainingController */
/* @var $data Videos */
?>

<div class="view">

	<b><?php echo CHtml::encode('Video'); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title) ,array('view', 'id'=>$data->videoid)); ?>
	<br/>

</div>