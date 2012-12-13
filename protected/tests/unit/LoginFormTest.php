<?php

class LoginFormTest extends WebTestCase
{
	public function testLoginForm()
	{
		$this->open("/security/login/login");
		$this->waitForPageToLoad("30000");
		// Check that the form elements were made.
		$this->assertTrue($this->isElementPresent("LoginForm_username"));
		$this->assertTrue($this->isElementPresent("LoginForm_password"));
	}
}
