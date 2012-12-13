<?php

class AddUserFormTest extends WebTestCase
{
	public function testAddUserForm()
	{
		$this->open("/security/registration/adduser");
		$this->waitForPageToLoad("30000");
		// Check that the form elements were made.
		
		//'username, firstname, lastname, email, phoneext, departmentid, roleid'
		
		$this->assertTrue($this->isElementPresent("AddUserForm_username"));
		$this->assertTrue($this->isElementPresent("AddUserForm_firstname"));
		$this->assertTrue($this->isElementPresent("AddUserForm_lastname"));
		$this->assertTrue($this->isElementPresent("AddUserForm_email"));
		$this->assertTrue($this->isElementPresent("AddUserForm_phoneext"));
		$this->assertTrue($this->isElementPresent("AddUserForm_departmentid"));
		$this->assertTrue($this->isElementPresent("AddUserForm_roleid"));
	}
}
