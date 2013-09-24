<?php
/* @var $this TrainingController */
/* @var $data TrainingResources */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->type) ,array('resourceIndex', 'type'=>$data->type)); ?>
	<br/>

</div>