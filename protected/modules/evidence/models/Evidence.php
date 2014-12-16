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
		$evidenceData = FALSE;
		
		$fh = fopen("C:\Users\cwilloughby\Desktop\Property Query by Incident.csv", "r");
		if($fh)
		{
			// This loop reads in each line of the csv one at a time.
			while(($result = fgetcsv($fh)) !== false)
			{
				// Ignore blank lines.
				if(array(null) !== $result)
				{
					$evidenceData[] = $result;
				}
			}
			fclose($fh);
		}
		
		return $evidenceData;
	}
}
