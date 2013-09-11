<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping register form data. 
 * It is used by the 'register' action of 'RegistrationController'.
 */
class RegisterForm extends CFormModel
{
	public $firstname;
	public $lastname;
	public $middlename;
	public $email;
	public $phoneext;
	public $departmentid;
	public $hiredate;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('firstname, lastname, email, phoneext, departmentid', 'required'),
			array('email', 'email'),
			array('email', 'doesNotExist'),
			array('phoneext', 'numerical', 'integerOnly'=>true),
		);
	}
	
	/**
	 * This function makes sure that the email does not already exist.
	 */
	public function doesNotExist($attribute, $params)
	{
		if(UserInfo::model()->find("email = '$this->email'"))
		{
			$this->addError($attribute, 'That ' . $attribute . " already exists.");
		}
	}
	
	/**
	 * Determine the attribute labels that will be shown to the users.
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
			'firstname'=>'First Name',
			'lastname'=>'Last Name',
			'middlename'=>'Middle Name',
			'email'=>'Email',
			'phoneext'=>'Phone Ext',
			'departmentid'=>'Department',
			'hiredate'=> 'Hire Date (mm/dd/yyyy)',
		);
	}
}
