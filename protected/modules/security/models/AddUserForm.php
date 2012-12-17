<?php

/*
 * AddUserForm class.
 * AddUserForm is the data structure for keeping user add user form data. 
 * It is used by the 'adduser' action of 'RegistrationController'.
 */
class AddUserForm extends CFormModel
{
	public $username;
	public $firstname;
	public $lastname;
	public $middlename;
	public $email;
	public $phoneext;
	public $departmentid;
	public $roleid;
	public $hiredate;
	
	private $_identity;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('username, firstname, lastname, email, phoneext, Departmentid, roleid', 'required'),
			array('email', 'email'),
			array('phoneext', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'username'=>'Username',
			'firstname'=>'First Name',
			'lastname'=>'Last Name',
			'middlename'=>'Middle Name',
			'email'=>'Email',
			'phoneext'=>'Phone Ext',
			'departmentid'=>'Department',
			'roleid'=>'Role',
			'hiredate'=>'Hire Date',
		);
	}
}
