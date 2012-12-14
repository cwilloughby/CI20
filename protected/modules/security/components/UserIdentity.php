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
			// Search the Role table for a matching primary key inorder to get the name of the user's role.
			$role = Roles::model()->findByPk($record->RoleID);
			
            $this->_id=$record->UserID;

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