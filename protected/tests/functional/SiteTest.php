<?php

class SiteTest extends WebTestCase
{
	public function testIndex()
	{
		$this->open(TEST_BASE_URL);
		$this->waitForPageToLoad("30000");
		$this->assertTextPresent('Welcome');
	}
	
	public function testContact()
	{
		$this->open('/site/contact');
		$this->assertTextPresent('Contact Us');
		$this->assertElementPresent('name=ContactForm[name]');

		$this->type('name=ContactForm[name]','tester');
		$this->type('name=ContactForm[email]','tester@example.com');
		$this->type('name=ContactForm[subject]','test subject');
		$this->click("//input[@value='Submit']");
		$this->waitForTextPresent('Body cannot be blank.');
	}
}
