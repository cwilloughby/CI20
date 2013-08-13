<?php

/**
 * Most interactions with the user related to the document processor will go through this class.
 */
class DocumentProcessorController extends Controller
{
	// Set the layout that views used by this controller will use by default.
	
	/**
	 * Some controller actions should only be accessed under certain conditions.
	 * This function sets those conditions.
	 * @return array action filters
	 */
	public function filters()
	{
		// Return an array of filter criteria.
	}
	
	/**
	 * Lists the files on the G drive in a searchable tree.
	 */
	public function actionSearchableListOfCommonFiles()
	{
		// Create Documents model object.
		
		// If the search was posted.
		{
			// Setup the dataProvider to only get records from the model whose paths are on the G drive that also
			// has the word or words that the user is searching for in any of these columns,
			// filename, uploadedby, uploaddate, modifydate, content
		}
		// else
		{
			// Setup the dataProvider to only get records from the model whose paths are on the G drive. 
		}
		
		// Call the view file and give it the dataprovider.
	}
	
	/**
	 * Lists all queues that the user has access to.
	 */
	public function actionListAccessibleQueues()
	{
		// Check the current user's priveleges to make a list of the queues that they have access to.
		
		// Send that list to the view.
	}
	
	/*
	 * Each specific document queue will most likely need its own action to handle each queue's unique requirements.
	 * Those requirements have yet to be determined, so this is just a placeholder for those future actions.
	 */
}
