<?php
/* @var $this CentriodController */
/* @var $warrant array */

if($warrant != "The warrant file does not exist!")
{
	echo "<h4>Location: " . $warrant['Location'] . "</h4>";

	foreach(array_slice($warrant, 1) as $charge)
	{
		echo "<table>"
			. "<tr><td>Warrant Type</td><td>" . $charge['CJIS Warrant Type'] . "</td></tr>"
			. "<tr><td>Warrant Number</td><td>" . $charge['Warrant Number'] . "</td></tr>"
			. "<tr><td>Incident Number</td><td>" . $charge['Incident Number'] . "</td></tr>"
			. "<tr><td>NCIC</td><td>" . $charge['NCIC'] . "</td></tr>"
			. "<tr><td>TCA Code</td><td>" . $charge['TCA Code'] . "</td></tr>"
		. "</table><hr>";
	}
}
else
	echo "<h4>" . $warrant . "</h4>";