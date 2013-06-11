<?php
/* @var $this TrainingController */
/* @var $data Videos */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->type) ,array('training/training/resourceIndex', 'type'=>$data->type)); ?>
	<br/>

</div>