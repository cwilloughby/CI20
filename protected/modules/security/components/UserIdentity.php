<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * credentials are valid.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	
	/**
	 * Authenticates a user.
	 * @return boolean whether authentication succeeds.
	 */
    public function authenticate()
    {
		// Search the database for the provided username.
        $record=UserInfo::model()->findByAttributes(array('Username'=>$this->username));
		
        if($record===null)
		{
			// The username does not exist.
            $this->errorCode=self::ERROR_USERNAME_INVALID;
		}
        else if($record->Password!==sha1($this->password))
		{
			// The password is invalid.
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
		}
        else
        {
			/*
			I haven't figured out how to take advantage of the table relationships that were made in 
			the model classes yet. So for now I'm searching the Role table directly for the role name.
			*/
			$role = Roles::model()->findByAttributes(array('RoleID'=>$record->RoleID));
			
            $this->_id=$record->UserID;
			print_r($role->RoleName);
            $this->setState('roles', $role->RoleName);
            $this->errorCode=self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
	
	public function getId()
	{
		return $this->_id;
	}
}