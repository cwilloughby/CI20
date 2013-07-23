<?php
/* @var $this WeatherController */
/* @var $weather array */
?>

<h1>12 Hour Forecast</h1>

<?php
if(!is_null($weather))
{
	echo CHtml::encode($weather['summary']) . "<br/>";
	echo "Minimum Temperature: " . CHtml::encode($weather['minTemp']) . "<br/>";
	echo "Maximum Temperature: " . CHtml::encode($weather['maxTemp']) . "<br/>";
	echo "Chance of Rain: " . CHtml::encode($weather['rainChance']) . "%";
}
else
	echo "Unable to obtain the forecast. Please try again later.";
?>
