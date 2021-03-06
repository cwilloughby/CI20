<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping user login form data. 
 * It is used by the 'login' action of 'LoginController'.
 */
class LoginForm extends CFormModel
{
	public $username;
	public $password;

	private $_identity;

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			// username and password are required.
			array('username, password', 'required'),
			// password needs to be authenticated.
			array('password', 'authenticate'),
		);
	}
	
	/**
	 * Authenticates the password.
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			if(!$this->_identity->authenticate())
				$this->addError('password','Incorrect username or password or your account is locked.');
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
			'username'=>'Username',
			'password'=>'Password'
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether the login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new UserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===UserIdentity::ERROR_NONE)
		{
			Yii::app()->user->login($this->_identity);
			
			// Record the successful login event.
			$this->recordLoginEvent('Login Succeeded');
			
			return true;
		}
		else
			return false;
	}
	
	/**
	 * This function will record the login event.
	 * @param string $event
	 */
	private function recordLoginEvent($event)
	{
		// Record the login event.
		$log = new Log;
		$log->tablename = 'ci_user_info';
		$log->event = $event;
		$log->userid = $this->_identity->getId();
		$log->tablerow = $log->userid;
		$log->save(false);
	}
}
