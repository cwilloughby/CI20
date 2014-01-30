<?php

/**
 * Most interactions with the user related to cjis dispositions will go through this class.
 */
class CJISDispoController extends Controller
{
	// Set the layout that views used by this controller will use by default.
	public $layout='//layouts/column2';
	
	/**
	 * Some controller actions should only be accessed under certain conditions.
	 * This function sets those conditions.
	 * @return array action filters
	 */
	public function filters()
	{
		// Return an array of filter criteria.
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	} // End function filters
	
	/**
	 * This function returns a list of external actions.
	 * External actions are identical functions shared by many controllers throughout ci2.
	 * The code for the external actions can be found in protected\components
	 * @return array
	 */
	function actions()
	{
		return array(
			'view' => array('class' => 'ViewAction', 'modelClass' => 'To Be Detemined'),
			'index' => array('class' => 'IndexAction', 'modelClass' => 'To Be Detemined'),
			'admin' => array('class' => 'AdminAction', 'modelClass' => 'To Be Detemined'),
		);
	}
}
