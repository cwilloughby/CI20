<?php

class HearingRequest extends CFormModel
{
	// This is the path to the image file used on the DA request page.
	const LOGO = "../../../../images/daLogo.jpg";
	// This is the hearing request email that all hearings are sent to.
	const TAPEEMAIL = "CCC_Tape_Requests@nashville.gov";
	
	public $defName, $caseNumber, $yourName, $yourEmail, $yourNumber, $yourExtension;
	
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('defName, caseNumber, yourName, yourEmail, yourNumber', 'required'),
			array('yourEmail', 'email'),
			array('yourNumber', 'phoneNumber'),
			array('yourExtension', 'numerical', 'integerOnly'=>true),
			array('yourExtension', 'length', 'min' => 3, 'max'=>7),
			array('defName', 'length', 'max'=>100),
			array('yourName', 'length', 'max'=>100),
			array('caseNumber', 'length', 'max'=>25),
			array('yourEmail', 'length', 'max'=>200),
		);
	}
	
	/** 
	* Checks the format of the phone number entered.
	* @param string $attribute the name of the attribute to be validated
	* @param array $params options specified in the validation rule
	*/
	public function phoneNumber($attribute,$params='')
	{
		if(preg_match("/^\(?\d{3}\)?[\s-]?\d{3}[\s-]?\d{4}$/", $this->$attribute) === 0)
		{   
			$this->addError($attribute,
				'Your Contact Number must be a valid phone number, in a form like (615) 555-1212 or 6155551212 or 615-555-1212' );  
		}
	}
	
	/**
	* Declares attribute labels.
	*/
    public function attributeLabels()
	{
		return array(
			'defName' => "Defendant's Full Name",
			'caseNumber' => "Case Number",
			'yourName' => "Your Name",
			'yourEmail' => "Your Email Address",
			'yourNumber' => "Contact Number",
			'yourExtension' => "Ext.",
		);
    }
}