<?php

class AttorneyTest extends CDbTestCase
{
	public $fixtures = array(
		'attorney' => 'Attorney'
	);
	
	/**
	 * This function tests that the doesAttorneyExist() function in the Attorney model,
	 * returns true when it should and that it returns false when it should.
	 */
	public function testAttorneyExistance()
	{
		$attorney = new Attorney;

		// This first check should return false, because there is no Attorney with a first name of "afsasdf"
		$attorney->fname = "afsasdf";
		$this->assertFalse($attorney->doesAttorneyExist(), "The test found an attorney when it should not have.");
		
		// This second check should return true, because there is an Attorney named "Hershell Koger"
		// NOTE: The null barid will mess up the search. There will need to be some kind of "IS NULL" check.
		$attorney->fname = "Hershell";
		$attorney->lname = "Koger";
		$attorney->barid = NULL;
		$this->assertTrue($attorney->doesAttorneyExist(), "The test did not find an attorney when it should have.");
	}
}
