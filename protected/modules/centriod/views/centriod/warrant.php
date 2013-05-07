<?php
/* @var $this CentriodController */
/* @var $warrant array */

if($warrant != "The warrant file does not exist!")
{
	echo "<h4>Location: " . $warrant['Location'] . "</h4>";

	foreach(array_slice($warrant, 1) as $charge)
	{
		echo "Warrant Type: " . $charge['CJIS Warrant Type'] . "<br/>";
		echo "Warrant Number: " . $charge['Warrant Number'] . "<br/>";
		echo "Incident Number: " . $charge['Incident Number'] . "<br/>";
		echo "NCIC: " . $charge['NCIC'] . "<br/>";
		echo "TCA Code: " . $charge['TCA Code'] . "<br/><br/>";
	}
}
else
	echo "<h4>" . $warrant . "</h4>";