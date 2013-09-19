<?php
/**
 * This class is used to obtain weather information from NOAA.
 */
class Weather
{
	// This is the url that is used to obtain the weather report.
	const WEATHER = 'http://graphical.weather.gov/xml/sample_products/browser_interface/ndfdBrowserClientByDay.php?lat=36.16652&lon=-86.780319&format=12+hourly&numDays=1';
	
	/**
	 * Get the weather report from NOAA for the Nashville area. Stores the results in the cache for 30 minutes
	 * to limit the number of requests sent to NOAA.
	 */
	public static function getWeather()
	{
		$value = Yii::app()->cache->get('weather');
		if($value === false)
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, self::WEATHER);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$value = curl_exec($curl);
			curl_close($curl);
		
			Yii::app()->cache->set('weather', $value, 3600);
		}
		return Weather::convertReport($value);
	}
	
	/**
	 * This function is used to obtain the mininum tempurature, maximum temperature, rain chance, and weathersummary
	 * from the xml and return them in an array. 
	 * @param string $xml the xml sent from NOAA
	 * @return array contains minTemp, maxTemp, rainChance, and summary
	 */
	private static function convertReport($xml)
	{
		libxml_use_internal_errors(true);
		$xml = simplexml_load_string($xml);
		if(libxml_get_errors())
			throw new Exception("XML Failure");
		libxml_clear_errors();
		
		if(isset($xml->data->parameters->temperature[1]->value))
		{
			$weather = array(
				'minTemp' => (string)$xml->data->parameters->temperature[1]->value,
				'maxTemp' => (string)$xml->data->parameters->temperature[0]->value,
				'rainChance' => (string)$xml->data->parameters->{'probability-of-precipitation'}->value[0],
				'summary' => (string)$xml->data->parameters->weather->{'weather-conditions'}->attributes()->{'weather-summary'}[0]
			);
		}
		else 
		{
			$weather = null;
		}
		
		return $weather;
	}
}
