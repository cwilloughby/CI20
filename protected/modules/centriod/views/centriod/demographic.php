<?php
/* @var $this CentriodController */
/* @var $demographic array */

if($demographic != "The demographic file does not exist!")
{
	echo "<h4>Location: " . $demographic['Location'] . "</h4>";
	?>

	<table class = "centriod">
		<tr>
			<td>
			<b>Element</b>
			</td>
			<td>
			<b>Start Point</b>
			</td>
			<td>
			<b>Length</b>
			</td>
			<td>
			<b>Value</b>
			</td>
		</tr>

	<?php 
	// Remove the location information from the array, then loop through the demographic information.
	foreach(array_slice($demographic, 1) as $demog)
	{
		?>
		<tr>
			<td>
			<?php echo $demog['Element']; ?>
			</td>
			<td>
			<?php echo $demog['Start Point']; ?>
			</td>
			<td>
			<?php echo $demog['Length']; ?>
			</td>
			<td>
			<?php echo $demog['Value']; ?>
			</td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}
else
	echo "<h4>" . $demographic . "</h4>";
