<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping user login form data. 
 * It is used by the 'login' action of 'LoginController'.
 */
class AddUserForm extends CFormModel
{
	public $username;
	public $firstname;
	public $lastname;
	public $email;
	public $phoneext;
	public $departmentid;
	public $roleid;

	private $_identity;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('username, firstname, lastname, email, phoneext, departmentid, roleid', 'required'),
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
	public function adduser()
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
