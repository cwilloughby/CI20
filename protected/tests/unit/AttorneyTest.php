<?php

class AttorneyTest extends CDbTestCase
{
	protected $attorney;
	
	protected function setUp()
	{
		$this->attorney = new Attorney;
	}
	
	/**
	 * This function tests out the various configuration functions for the attorney model.
	 * They are all gii generated.
	 */
	public function testAttorneyConfigs()
	{
		// The name of the table should be ci_attorney
		$this->assertEquals('ci_attorney', $this->attorney->tableName());
		// These three attorney model functions should all return arrays.
		$this->assertInternalType('array', $this->attorney->rules());
		$this->assertInternalType('array', $this->attorney->relations());
		$this->assertInternalType('array', $this->attorney->attributeLabels());
	}
	
	/**
	 * This function tests that the doesAttorneyExist() function in the Attorney model,
	 * returns true when it should and that it returns false when it should.
	 */
	public function testAttorneyExistance()
	{
		// This first check should return false, because there is no Attorney with this name.
		$this->attorney->fname = "afsasdf";
		$this->attorney->lname = "eqwrqwer";
		$this->attorney->barid = NULL;
		$results = $this->attorney->doesAttorneyExist();
		$this->assertInternalType('boolean', $results);
		$this->assertFalse($results, "The test found an attorney when it should not have.");
		
		// This second check should return true, because there is an Attorney named "Hershell Koger"
		// NOTE: The null barid will mess up the search. There will need to be some kind of "IS NULL" check.
		$this->attorney->fname = "Hershell";
		$this->attorney->lname = "Koger";
		$this->attorney->barid = NULL;
		$results = $this->attorney->doesAttorneyExist();
		$this->assertInternalType('boolean', $results);
		$this->assertTrue($results, "The test did not find an attorney when it should have.");
	}
	
	/**
	 * This function tests out the getAttorneyId function in the attorney model.
	 */
	public function testGetAttorneyId()
	{
		// Let's pretend that the user entered this information for an attorney that does not exist.
		$formData['fname'] = "afsasdf";
		$formData['lname'] = "eqwrqwer";
		$formData['barid'] = NULL;
		// Call the getAttorneyId function and check that the return value is an integer.
		$returnValue = $this->attorney->getAttorneyId($formData);
		$this->assertInternalType('integer', $returnValue);
		// The number that was returned should match an attyid in the database.
		$this->assertTrue($this->attorney->exists('attyid = :id ', array(':id'=>$returnValue)),
				"The Attorney ID that was returned was not actually in the database!");
		
		// Let's pretend that the user entered this information for an attorney that does exist.
		$formData['fname'] = "Hershell";
		$formData['lname'] = "Koger";
		$formData['barid'] = NULL;
		// Call the getAttorneyId function and check that the return value is an integer.
		$returnValue = $this->attorney->getAttorneyId($formData);
		$this->assertInternalType('integer', $returnValue);
		// The number that was returned should match an attyid in the database.
		$this->assertTrue($this->attorney->exists('attyid = :id ', array(':id'=>$returnValue)),
				"The Attorney ID that was returned was not actually in the database!");
	}
}
