<?php
/* @var $this TrainingController */
/* @var $data Videos */
?>

<td>
	<table>
		<tr>
			<td>
			<b><?php echo CHtml::encode($data->title); ?></b>
			</td>
		</tr>
		<tr>
			<td>
			<?php 
			if($data->category == 'Video')
			{
				echo "<div class='photolinks'>";
				echo CHtml::link('<img src="'. Yii::app()->request->baseUrl . '/themes/abound/img/' . $data->poster . '" alt="' . $data->title . '"/>', 
					array('view', 'id'=>$data->videoid, 'type'=>$data->type));
				echo "</div>";
			}
			else
			{
				echo "<div class='photolinks'>";
				echo CHtml::link('<img src="'. Yii::app()->request->baseUrl . '/themes/abound/img/' . $data->poster . '" alt="' . $data->title . '"/>', 
					array(Yii::app()->request->baseUrl . "/assets/training/" . $data->document->documentname));
				echo "</div>";
			}
			?>
			</td>
		</tr>
	</table>
</td>