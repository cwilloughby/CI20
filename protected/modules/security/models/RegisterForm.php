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
	public $email;
	public $phoneext;
	public $departmentid;
	
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
			array('phoneext', 'numerical', 'integerOnly'=>true),
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
			'email'=>'Email',
			'phoneext'=>'Phone Ext',
			'departmentid'=>'Department',
			'roleid'=>'Role',
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function register()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			return true;
		}
		else
			return false;
	}
}
