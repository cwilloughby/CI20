<?php
/* @var $this CentriodController */
/* @var $aliases array */

if($aliases != "This arrest has no alias file.")
{
	echo "<h4>Location: " . $aliases['Location'] . "</h4>";

	foreach(array_slice($aliases, 1) as $alias)
	{
		echo "Last Name: " . $alias['Alias Last Name'] . "<br/>";
		echo "First Name: " . $alias['Alias First Name'] . "<br/>";
		echo "Middle Name: " . $alias['Alias Middle Name'] . "<br/>";
		echo "Suffix: " . $alias['Alias Suffix'] . "<br/>";
		echo "UID Initials: " . $alias['Alias UID Initials'] . "<br/>";
		echo "UID Count: " . $alias['Alias UID Count'] . "<br/><br/>";
	}
}
else
	echo "<h4>" . $aliases . "</h4>";
