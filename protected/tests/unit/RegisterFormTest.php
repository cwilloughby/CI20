<?php

class RegisterFormTest extends WebTestCase
{
	public function testRegisterForm()
	{
		$this->open("/security/registration/register");
		$this->waitForPageToLoad("30000");
		// Check that the form elements were made.
		$this->assertTrue($this->isElementPresent("RegisterForm_firstname"));
		$this->assertTrue($this->isElementPresent("RegisterForm_lastname"));
		$this->assertTrue($this->isElementPresent("RegisterForm_email"));
		$this->assertTrue($this->isElementPresent("RegisterForm_phoneext"));
		$this->assertTrue($this->isElementPresent("RegisterForm_departmentid"));
	}
}
