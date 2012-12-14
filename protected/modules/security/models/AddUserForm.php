<?php

/*
 * AddUserForm class.
 * AddUserForm is the data structure for keeping user add user form data. 
 * It is used by the 'adduser' action of 'RegistrationController'.
 */
class AddUserForm extends CFormModel
{
	public $Username;
	public $FirstName;
	public $LastName;
	public $MiddleName;
	public $Email;
	public $PhoneExt;
	public $DepartmentID;
	public $RoleID;
	public $HireDate;
	
	private $_identity;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('Username, FirstName, LastName, Email, PhoneExt, DepartmentID, RoleID', 'required'),
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
			'Username'=>'Username',
			'FirstName'=>'First Name',
			'LastName'=>'Last Name',
			'MiddleName'=>'Middle Name',
			'Email'=>'Email',
			'PhoneExt'=>'Phone Ext',
			'DepartmentID'=>'Department',
			'RoleID'=>'Role',
			'HireDate'=>'Hire Date',
		);
	}
}
