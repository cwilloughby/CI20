<?php
/**
 * This class is used to obtain the flat files that will be used by centriod.
 */
class Centriod extends CModel
{
	// These are the paths to the folders where the flat files are.
	//const SUCCESS = '\\\\10.107.12.183\\DATA\\FTP\\Courts2\\Success\\Arrest\\Final\\';
	//const FAILED = '\\\\10.107.12.183\\DATA\\FTP\\Courts2\\Failed\\Arrest\\Final\\';
	
	const SUCCESS = '\\\\jis18828\\DATA\\FTP\\Courts2\\Success\\Arrest\\Final\\';
	const FAILED = '\\\\jis18828\\DATA\\FTP\\Courts2\\Failed\\Arrest\\Final\\';
	
	public $arrestnumber;
	
	// Load CJIS Layout Data into an array.
	private $demographic = array(
					array('Arrest Element' => 'Arrest Number', 'Start Point' => 0, 'Length' => 9),
					array('Arrest Element' => 'Arrest Incident', 'Start Point' => 9, 'Length' => 11),
					array('Arrest Element' => 'Arrest Citation', 'Start Point' => 20, 'Length' => 8),
					array('Arrest Element' => 'Arrest Date', 'Start Point' => 28, 'Length' => 8),
					array('Arrest Element' => 'Arrest Time', 'Start Point' => 36, 'Length' => 4),
					array('Arrest Element' => 'OCA', 'Start Point' => 40, 'Length' => 12),
					array('Arrest Element' => 'Real Last Name', 'Start Point' => 52, 'Length' => 30),
					array('Arrest Element' => 'Real First Name', 'Start Point' => 82, 'Length' => 30),
					array('Arrest Element' => 'Real Middle Name', 'Start Point' => 112, 'Length' => 30),
					array('Arrest Element' => 'Real Suffix', 'Start Point' => 142, 'Length' => 10),
					array('Arrest Element' => 'Real UID Initials', 'Start Point' => 152, 'Length' => 4),
					array('Arrest Element' => 'Real UID Count', 'Start Point' => 156, 'Length' => 10),
					array('Arrest Element' => 'Real Date of Birth', 'Start Point' => 166, 'Length' => 8),
					array('Arrest Element' => 'Real Height', 'Start Point' => 174, 'Length' => 4),
					array('Arrest Element' => 'Real Weight', 'Start Point' => 174, 'Length' => 3),
					array('Arrest Element' => 'Real Race', 'Start Point' => 180, 'Length' => 1),
					array('Arrest Element' => 'Real Ethnicity', 'Start Point' => 181, 'Length' => 1),
					array('Arrest Element' => 'Real Sex', 'Start Point' => 182, 'Length' => 1),
					array('Arrest Element' => 'Real Eye', 'Start Point' => 183, 'Length' => 3),
					array('Arrest Element' => 'Real Hair', 'Start Point' => 186, 'Length' => 3),
					array('Arrest Element' => 'Latest Address', 'Start Point' => 189, 'Length' => 30),
					array('Arrest Element' => 'Latest Address Description', 'Start Point' => 219, 'Length' => 30),
					array('Arrest Element' => 'Real City', 'Start Point' => 249, 'Length' => 20),
					array('Arrest Element' => 'Real State', 'Start Point' => 269, 'Length' => 2),
					array('Arrest Element' => 'Real Zip', 'Start Point' => 271, 'Length' => 10),
					array('Arrest Element' => 'Real County Code', 'Start Point' => 281, 'Length' => 3),
					array('Arrest Element' => 'Real OLN', 'Start Point' => 284, 'Length' => 25),
					array('Arrest Element' => 'Real SSN', 'Start Point' => 309, 'Length' => 10),
					array('Arrest Element' => 'Verified', 'Start Point' => 319, 'Length' => 1),
					array('Arrest Element' => 'Arrest Location', 'Start Point' => 320, 'Length' => 50),
					array('Arrest Element' => 'Arresting Officer MPD No', 'Start Point' => 370,'Length' => 10),
					array('Arrest Element' => 'License State', 'Start Point' => 380, 'Length' => 2),
					array('Arrest Element' => 'License Number', 'Start Point' => 382, 'Length' => 18),
					array('Arrest Element' => 'License Year', 'Start Point' => 400, 'Length' => 4),
					array('Arrest Element' => 'SMT1', 'Start Point' => 404, 'Length' => 10),
					array('Arrest Element' => 'SMT1 Desc of Neumonic', 'Start Point' => 414, 'Length' => 60),
					array('Arrest Element' => 'SMT1 Desc of SMT', 'Start Point' => 474, 'Length' => 30),
					array('Arrest Element' => 'SMT2', 'Start Point' => 504, 'Length' => 10),
					array('Arrest Element' => 'SMT2 Desc of Neumonic', 'Start Point' => 514, 'Length' => 60),
					array('Arrest Element' => 'SMT2 Desc of SMT', 'Start Point' => 574, 'Length' => 30),
					array('Arrest Element' => 'SMT3', 'Start Point' => 604, 'Length' => 10),
					array('Arrest Element' => 'SMT3 Desc of Neumonic', 'Start Point' => 614, 'Length' => 60),
					array('Arrest Element' => 'SMT3 Desc of SMT', 'Start Point' => 674, 'Length' => 30),
					array('Arrest Element' => 'Persistent Offender', 'Start Point' => 704, 'Length' => 1),
					array('Arrest Element' => 'Violent Offender', 'Start Point' => 705, 'Length' => 1),
					array('Arrest Element' => 'Arrest Refused', 'Start Point' => 707, 'Length' => 1),
					array('Arrest Element' => 'Jail Tracking Number', 'Start Point' => 707, 'Length' => 8)
				); // End of Demographic array
	
	private $warrant = array(
					array('Arrest Element' => 'CJIS Warrant Type', 'Start Point' => 0, 'Length' => 1),
					array('Arrest Element' => 'Warrant Number', 'Start Point' => 1, 'Length' => 15),
					array('Arrest Element' => 'Incident Number', 'Start Point' => 16, 'Length' => 11),
					array('Arrest Element' => 'NCIC', 'Start Point' => 27, 'Length' => 4),
					array('Arrest Element' => 'TCA Code', 'Start Point' => 31, 'Length' => 25),
				); // End of Warrant array
	
	private $alias = array(
					array('Arrest Element' => 'Alias Last Name', 'Start Point' => 0, 'Length' => 30),
					array('Arrest Element' => 'Alias First Name', 'Start Point' => 30, 'Length' => 30),
					array('Arrest Element' => 'Alias Middle Name', 'Start Point' => 60, 'Length' => 30),
					array('Arrest Element' => 'Alias Suffix', 'Start Point' => 90, 'Length' => 10),
					array('Arrest Element' => 'Alias UID Initials', 'Start Point' => 100, 'Length' => 4),
					array('Arrest Element' => 'Alias UID Count', 'Start Point' => 105, 'Length' => 10)
				); // End of Alias array
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('arrestnumber', 'required'),
			array('arrestnumber', 'numerical', 'integerOnly'=>true),
		);
	}
	
	/**
	 * This model does not correspond with a database table, so we have to define the attributes manually.
	 * @return array
	 */
	public function attributeNames()
	{
		// Return an array of attributes.
		return array('arrestnumber'=>'Arrest Number');
	}
	
	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
			'arrestnumber' => 'Arrest Number'
		);
	}
	
	/**
	 * This function creates a report on the contents of the warrant, demographic, and alias files, then returns it.
	 * @return array
	 */
	public function reportFiles()
	{
		// Find the files.
		$files = $this->locateFiles();
		// Read in the files and parse them into an array.
		$parsedFiles = $this->parseFileContents($files);
		// Search the array for common errors and highlight them.
		$report = $this->findErrors($parsedFiles);
		
		return $report;
	}
	
	/**
	 * This function will first check the success folder for the warrant, demographic and alias files,
	 * if it can't find them there it will look for them in the failed folder.
	 * @return array $files
	 */
	private function locateFiles()
	{	
		$files = array();
		
		try
		{
			// Determine where the demographic file is.
			if(file_exists(self::SUCCESS . $this->arrestnumber . "D"))
				$files['Demographic'] = self::SUCCESS . $this->arrestnumber . "D";
			else if(file_exists(self::FAILED . $this->arrestnumber . "D"))
				$files['Demographic'] = self::FAILED . $this->arrestnumber . "D";
			else
				$files['Demographic'] = 'Does not exist!';

			// Determine where the warrant file is.
			if(file_exists(self::SUCCESS . $this->arrestnumber . "W"))
				$files['Warrant'] = self::SUCCESS . $this->arrestnumber . "W";
			else if(file_exists(self::FAILED . $this->arrestnumber . "W"))
				$files['Warrant'] = self::FAILED . $this->arrestnumber . "W";
			else
				$files['Warrant'] = 'Does not exist!';

			// Determine where the alias file is.
			if(file_exists(self::SUCCESS . $this->arrestnumber . "A"))
				$files['Alias'] = self::SUCCESS . $this->arrestnumber . "A";
			else if(file_exists(self::FAILED . $this->arrestnumber . "A"))
				$files['Alias'] = self::FAILED . $this->arrestnumber . "A";
			else
				$files['Alias'] = 'This arrest has no alias file.';
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "CMM1: Centriod file locator failed with error " . $ex);
		}
		
		return $files;
	} // End of function locateFiles
	
	/**
	 * Convert the contents of the flat file into an array.
	 * @param array $files an array containing the location of the files.
	 * @return array $parsedFiles
	 */
	private function parseFileContents($files)
	{
		$parsedFiles = array();
		
		try
		{
			// Make sure the Warrant file exists.
			if($files['Warrant'] != 'Does not exist!')
			{
				$handle = @fopen($files['Warrant'], 'r');

				if($handle)
				{
					$row = 0;
					$parsedFiles['Warrant']['Location'] = $files['Warrant'];

					// Normally a flat file has everything on one line, but the warrant file seperates the charges into different lines.
					// This loop iterates through each line. So each iteration is a seperate charge.
					while(!feof($handle)) 
					{
						// Grab a line from the file.
						$buffer = fgets($handle, 4096);
						if($buffer != "")
						{
							$count = count($this->warrant);	

							// Element refers to things like, warrant number, ncic, tca, ect. So this loop goes through each one.
							for($element = 0; $element < $count; $element++)
							{
								$parsedFiles['Warrant']['Charge' . ($row + 1)][$this->warrant[$element]['Arrest Element']] 
									= trim(substr($buffer, $this->warrant[$element]['Start Point'], $this->warrant[$element]['Length']));
							}
						}
						// Increase the line number.
						$row++;
					}
					fclose($handle);
				}
			}
			else
				$parsedFiles['Warrant'] = "The warrant file does not exist!";

			// Make sure the Alias file exists.
			if($files['Alias'] != 'This arrest has no alias file.')
			{
				$handle = @fopen($files['Alias'], 'r');

				if($handle) 
				{
					$row = 0;
					$parsedFiles['Alias']['Location'] = $files['Alias'];

					// Normally a flat file has everything on one line, but the alias file seperates the aliases into different lines.
					// This loop iterates through each line. So each iteration is a seperate alias.
					while(!feof($handle)) 
					{
						// Grab a line from the file.
						$buffer = fgets($handle, 4096);
						if($buffer != "")
						{
							$count = count($this->alias);	

							// Element refers to things like, first name, last name, suffix, ect. So this loop goes through each one.
							for($element = 0; $element < $count; $element++)
							{
								$parsedFiles['Alias']['Alias' . ($row + 1)][$this->alias[$element]['Arrest Element']] 
										= trim(substr($buffer, $this->alias[$element]['Start Point'], $this->alias[$element]['Length']));
							}
						}
						// Increase the line number.
						$row++;
					}
					fclose($handle);
				}
			}
			else
				$parsedFiles['Alias'] = 'This arrest has no alias file.';

			// Make sure the Demographic file exists.
			if($files['Demographic'] != 'Does not exist!')
			{
				$handle = @fopen($files['Demographic'], 'r');

				if($handle) 
				{
					// Grab a line from the file.
					$buffer = fgets($handle, 4096);
					$parsedFiles['Demographic']['Location'] = $files['Demographic'];

					if($buffer != "")
					{
						$count = count($this->demographic);	

						for($element = 0; $element < $count; $element++)
						{
							$parsedFiles['Demographic']['Element' . ($element + 1)]['Element']
									= $this->demographic[$element]['Arrest Element'];
							$parsedFiles['Demographic']['Element' . ($element + 1)]['Start Point'] 
									= $this->demographic[$element]['Start Point'];
							$parsedFiles['Demographic']['Element' . ($element + 1)]['Length'] 
									= $this->demographic[$element]['Length'];
							$parsedFiles['Demographic']['Element' . ($element + 1)]['Value'] 
									= trim(substr($buffer, $this->demographic[$element]['Start Point'], $this->demographic[$element]['Length']));
						}
					}
					fclose($handle);
				}
			}
			else
				$parsedFiles['Demographic'] = "The demographic file does not exist!";
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "CMM2: Centriod file parser failed with error " . $ex);
		}
		
		return $parsedFiles;
	} // End of function parseFileContents
	
	/**
	 * This function takes an array containing parsed information from the centriod flat files
	 * and then runs the various error checker functions on it.
	 * @param array $parsedData
	 * @return array
	 */
	private function findErrors($parsedData)
	{
		try
		{
			if($parsedData['Demographic'] != "The demographic file does not exist!")
			{
				$parsedData['Demographic'] = $this->checkStates($parsedData['Demographic']);
				$parsedData['Demographic'] = $this->checkDemographicNumbers($parsedData['Demographic']);
				$parsedData['Demographic'] = $this->checkBlankDemographic($parsedData['Demographic']);
			}
			if($parsedData['Warrant'] != "The warrant file does not exist!")
			{
				$parsedData['Warrant'] = $this->checkWarrantValues($parsedData['Warrant']);
				$parsedData['Warrant'] = $this->checkBlankWarrant($parsedData['Warrant']);
			}
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, "CMM3: Centriod error detector failed with error " . $ex);
		}
		return $parsedData;
	}
	
	/**
	 * This function makes sure that the state abbreviations in the demographic file are valid.
	 * @param array $demographic
	 * @return array
	 */
	private function checkStates($demographic)
	{
		// Check the Real State value.
		if(!preg_match('/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/', $demographic['Element24']['Value']))
		{
			// Highlight the field with the error.
			$demographic['Element24']['Value'] = "<div class = 'centriod'><b>" . $demographic['Element24']['Value'] . "</b></div>";
		}
		
		// Check the License State value.
		if(!preg_match('/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/', $demographic['Element32']['Value']))
		{
			// Highlight the field with the error.
			$demographic['Element32']['Value'] = "<div class = 'centriod'><b>" . $demographic['Element32']['Value'] . "</b></div>";
		}
		
		return $demographic;
	}
	
	/**
	 * This function will make sure that number related demographic values are valid.
	 * @param array $demographic
	 * @return array
	 */
	private function checkDemographicNumbers($demographic)
	{
		// The arrest number should contain only numbers and be 9 numbers long.
		if(!preg_match('/^([0-9]{9})*$/', $demographic['Element1']['Value']))
		{
			// Highlight the field with the error.
			$demographic['Element1']['Value'] = "<div class = 'centriod'><b>" . $demographic['Element1']['Value'] . "</b></div>";
		}
		
		// The incident number should contain only numbers and be 11 numbers long.
		if(!preg_match('/^([0-9]{11})*$/', $demographic['Element2']['Value']))
		{
			// Highlight the field with the error.
			$demographic['Element2']['Value'] = "<div class = 'centriod'><b>" . $demographic['Element2']['Value'] . "</b></div>";
		}
		
		// The social security number should contain only numbers and be 9 numbers long.
		if(!preg_match('/^([0-9]{9})*$/', $demographic['Element28']['Value']))
		{
			// Highlight the field with the error.
			$demographic['Element28']['Value'] = "<div class = 'centriod'><b>" . $demographic['Element28']['Value'] . "</b></div>";
		}
		
		// The suffix should not contain a number.
		if(!preg_match('/^(\D)*$/', $demographic['Element10']['Value']))
		{
			// Highlight the field with the error.
			$demographic['Element10']['Value'] = "<div class = 'centriod'><b>" . $demographic['Element10']['Value'] . "</b></div>";
		}
		
		return $demographic;
	}
	
	/**
	 * This function finds any blank elements in the demographic info.
	 * @param array $demographic
	 * @return array
	 */
	private function checkBlankDemographic($demographic)
	{
		// Check the demographic file for blanks and highlight them.
		foreach(array_slice($demographic, 1) as $element => $sub)
		{
			if($sub['Value'] == "")
			{
				// Highlight the blank field.
				$demographic[$element]['Value'] = "<div class = 'centriod'>&nbsp</div>";
			}
		}
		return $demographic;
	}
	
	/**
	 * Warrant files are so small, that all the warrant value checks will be done here.
	 * @param array $warrant
	 * @return array
	 */
	private function checkWarrantValues($warrant)
	{
		foreach(array_slice($warrant, 1) as $charge => $sub)
		{
			// The CJIS Warrant Type should contain exactly 1 letter.
			if(!preg_match('/^([A-Z]{1})$/', $warrant[$charge]['CJIS Warrant Type']))
			{
				// Highlight the field with the error.
				$warrant[$charge]['CJIS Warrant Type'] = "<div class = 'centriod'><b>" . $warrant[$charge]['CJIS Warrant Type'] . "</b></div>";
			}
			
			// The Warrant Number should contain 2 or 3 letters followed by numbers.
			if(!preg_match('/^(([A-Z]{2}|[A-Z]{3}))\d+$/', $warrant[$charge]['Warrant Number']))
			{
				// Highlight the field with the error.
				$warrant[$charge]['Warrant Number'] = "<div class = 'centriod'><b>" . $warrant[$charge]['Warrant Number'] . "</b></div>";
			}
			
			// The NCIC number should contain only numbers and be exactly 4 numbers long.
			if(!preg_match('/^([0-9]{4})$/', $warrant[$charge]['NCIC']))
			{
				// Highlight the field with the error.
				$warrant[$charge]['NCIC'] = "<div class = 'centriod'><b>" . $warrant[$charge]['NCIC'] . "</b></div>";
			}
		}
		return $warrant;
	}
	
	/**
	 * This function finds any blank values in the warrant.
	 * @param array $warrant
	 * @return array
	 */
	private function checkBlankWarrant($warrant)
	{
		// Chech the warrant file for blanks and highlight them.
		foreach(array_slice($warrant, 1) as $charge => $sub)
		{
			// Find the array keys to all the blank values.
			$v = array_keys($sub, "");

			foreach($v as $key)
			{
				// Highlight the blank field.
				$warrant[$charge][$key] = "<div class = 'centriod'>&nbsp</div>";
			}
		}
		return $warrant;
	}
}
