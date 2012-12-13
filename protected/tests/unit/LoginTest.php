<?php

class LoginTest extends CDbTestCase
{
	public function testLoginForm()
	{
		$user = new UserInfo;
		
		$record=$user::model()->findByAttributes(array('Username'=>'cwilloughby'));
		
		// Test that it was retrieved successfully.
		$this->assertNotNull($record);
		// Test password recognition.
		$this->assertEquals($record->Password, sha1('cwilloughby'));
	}
}
