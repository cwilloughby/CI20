<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping user login form data. 
 * It is used by the 'login' action of 'LoginController'.
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
	
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that firstname, lastname, email, phoneext, departmentid, and roleid are required,
	 */
	public function rules()
	{
		return array(
			array('firstname, lastname, email, phoneext, departmentid', 'required'),
			array('email', 'email'),
			array('PhoneExt', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'firstname'=>'First Name',
			'lastname'=>'Last Name',
			'middlename'=>'Middle Name',
			'email'=>'Email',
			'phoneext'=>'Phone Ext',
			'departmentid'=>'Department',
			'hiredate'=> 'Hire Date',
		);
	}
}
