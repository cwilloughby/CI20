<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping user login form data. 
 * It is used by the 'login' action of 'LoginController'.
 */
class RegisterForm extends CFormModel
{
	public $FirstName;
	public $LastName;
	public $MiddleName;
	public $Email;
	public $PhoneExt;
	public $DepartmentID;
	public $HireDate;
	
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that firstname, lastname, email, phoneext, departmentid, and roleid are required,
	 */
	public function rules()
	{
		return array(
			array('FirstName, LastName, Email, PhoneExt, DepartmentID', 'required'),
			array('Email', 'email'),
			array('PhoneExt', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'FirstName'=>'First Name',
			'LastName'=>'Last Name',
			'MiddleName'=>'Middle Name',
			'Email'=>'Email',
			'PhoneExt'=>'Phone Ext',
			'DepartmentID'=>'Department',
			'HireDate'=> 'Hire Date',
		);
	}
}
