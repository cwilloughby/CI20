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
				echo CHtml::link('<img class="thumbnail photolinks" src="' . $data->poster . '" alt="' . $data->title . '"/>', 
					array('view', 'id'=>$data->resourceid, 'type'=>$data->type));
				echo "<p class='thumbnail caption phototitle'>$data->title</p>";
			}
			else
			{
				echo CHtml::link('<img class="thumbnail photolinks" src="'. $data->poster . '" alt="' . $data->title . '"/>', 
					array("/files/training/" . $data->document->documentname));
				echo "<p class='thumbnail caption phototitle'>$data->title</p>";
			}
			?>
			</td>
		</tr>
	</table>
</td>