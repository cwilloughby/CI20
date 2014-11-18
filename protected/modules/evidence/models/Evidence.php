<?php
/**
 * This class is used to obtain weather information from NOAA.
 */
class Evidence extends CFormModel
{
	// This is the url that is used to obtain the evidence report.
	const EVIDENCE = 'test';
	
	public $cpn;
	
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('cpn', 'required'),
			array('cpn', 'numerical', 'integerOnly'=>true),
			array('cpn', 'length', 'min' => 11, 'max'=>11), 
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cpn', 'safe', 'on'=>'search')
		);
	}
	
	/**
	* Declares attribute labels.
	*/
    public function attributeLabels()
	{
		return array(
			'cpn' => 'Complaint Number',
		);
    }
	
	/**
	 * Get the evidence from the MPD.
	 */
	public static function getEvidence()
	{
		/*
		$value = Yii::app()->cache->get('weather');
		if($value === false)
		{
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, self::WEATHER);
			curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)');
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HEADER, false);
			$value = curl_exec($curl);
			curl_close($curl);
		
			Yii::app()->cache->set('weather', $value, 3600);
		}
		return Evidence::convertReport($value);
		*/
	}
	
	/**
	 * This function is used to parse out the information obtained from the web service return them in an array. 
	 * @param string $xml the xml sent from the MPD
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
