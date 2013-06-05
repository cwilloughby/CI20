<?php
/* @var $this TrainingController */
/* @var $data Videos */
?>

<td>
	<table>
	<tr><td><b><?php echo CHtml::encode($data->title); ?></b><td></tr>
	<tr>
	<td>
	<?php 
	echo CHtml::link('<img src="'. Yii::app()->request->baseUrl . '/assets/images/test.png" alt="' . $data->title . '"/>', 
			array('view', 'id'=>$data->videoid, 'type'=>$data->type)); 
	?>
	</tr></td>
	</table>
</td>