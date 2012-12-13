<?php

/**
 * Description of ContactTest
 *
 * @author cwilloughby
 */
class ContactTest extends WebTestCase {

	function testMyTestCase() {
		$this->open("/site/contact");
		$this->assertTrue($this->isTextPresent("Contact Us"));
		$this->click("link=Contact");
		$this->waitForPageToLoad("30000");
		$this->assertTrue($this->isElementPresent("ContactForm_name"));
		$this->assertTrue($this->isElementPresent("ContactForm_email"));
	}
}
