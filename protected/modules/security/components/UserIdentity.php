<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * credentials are valid.
 */
class UserIdentity extends CUserIdentity
{
	const ERROR_USERNAME_NOT_ACTIVE = 3;
	private $_id;
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
    public function authenticate()
    {
		// Search the database for the provided username.
        $record=UserInfo::model()->findByAttributes(array('username'=>$this->username));
		
        if($record===null)
		{
			// The username does not exist.
            $this->errorCode=self::ERROR_USERNAME_INVALID;
		}
		else if($record->active == 2)
		{
			// That user account is disabled.
			$this->errorCode=self::ERROR_USERNAME_NOT_ACTIVE;
		}
        else if($record->password!==sha1($this->password))
		{
			// The password is invalid.
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
        else
        {
            $this->_id=$record->userid;

            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
	
	public function getId()
	{
		return $this->_id;
	}
}