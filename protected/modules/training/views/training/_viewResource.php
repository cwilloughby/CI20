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
				echo CHtml::link('<img class="thumbnail photolinks" src="'. Yii::app()->request->baseUrl . '/themes/abound/img/' . $data->poster . '" alt="' . $data->title . '"/>', 
					array('view', 'id'=>$data->resourceid, 'type'=>$data->type));
				echo "<caption class='thumbnail caption phototitle'>$data->title</caption></img>";
			}
			else
			{
				echo CHtml::link('<img class="thumbnail photolinks" src="'. Yii::app()->request->baseUrl . '/themes/abound/img/' . $data->poster . '" alt="' . $data->title . '"/>', 
					array("/files/training/" . $data->document->documentname));
				echo "<caption class='thumbnail caption phototitle'>$data->title</caption></img>";
			}
			?>
			</td>
		</tr>
	</table>
</td>