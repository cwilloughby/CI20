<?php
/* @var $this TrainingController */
/* @var $data TrainingResources */
?>

<td class="wrapper">
	<table>
		<tr>
			<td>
			<?php 
			if($data->category == 'Video')
			{
				echo "<caption class='thumbnail caption phototitle'>$data->title</caption></img>";
				echo CHtml::link('<img class="thumbnail photolinks" src="'. Yii::app()->request->baseUrl . '/themes/abound/img/' . $data->poster . '.png" alt="' . $data->title . '"/>', 
					array('view', 'id'=>$data->resourceid, 'type'=>$data->type));
			}
			else
			{
				echo "<caption class='thumbnail caption phototitle'>$data->title</caption></img>";
				echo CHtml::link('<img class="thumbnail photolinks" src="'. Yii::app()->request->baseUrl . '/themes/abound/img/' . $data->poster . '.png" alt="' . $data->title . '"/>', 
					array("/files/training/" . $data->document->documentname));
			}
			?>
			</td>
		</tr>
	</table>
</td>