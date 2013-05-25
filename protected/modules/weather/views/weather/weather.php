<?php
/* @var $this WeatherController */
/* @var $weather array */
?>

<h1>12 Hour Forecast</h1>

<?php
if(!is_null($weather))
{
	echo $weather['summary'] . "<br/>";
	echo "Minimum Temperature: " . $weather['minTemp'] . "<br/>";
	echo "Maximum Temperature: " . $weather['maxTemp'] . "<br/>";
	echo "Chance of Rain: " . $weather['rainChance'] . "%";
}
else
	echo "Unable to obtain the forecast. Please try again later.";
?>
