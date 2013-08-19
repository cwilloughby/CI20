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
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	} // End function filters
	
	/**
	 * Lists the files in all the queues even if the files are marked as completed.
	 */
	public function actionAdminSearchableFileList()
	{
		// Create Documents model object.
		
		// Setup the dataProvider to only get records from the model whose paths are on the G drive.
		
		// Call the view file and give it the dataprovider.
	} // End function actionAdminSearchableFileList
	
	/**
	 * Lists all the logged events related to the requested file.
	 */
	public function actionShowFileEventLog($documentid)
	{
		// Create Documents model object and tell it to find a record with that documentid.
		
		// Setup the dataProvider to only get records from the log model related to the ci_documents and ci_document_queues
		// tables related to the provided documentid.
		
		// Call the view file and give it the dataprovider and document model objects.
	} // End function actionShowFileEventLog
	
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
	} // End function actionSearchableListOfCommonFiles
	
	/**
	 * Lists all queues that the user has access to.
	 */
	public function actionListAccessibleQueues()
	{
		// Check the current user's priveleges to make a list of the queues that they have access to.
		
		// Send that list to the view.
	} // End function actionListAccessibleQueues
	
	/**
	 * Lists the files on the G drive in a searchable tree.
	 */
	public function actionShareValidatedFiles()
	{
		// Create Documents model object.
		
		// Try to catch errors.
		{
			// Send the requested files to the model so it can return an array of documentnames and documentpaths.
		}
		// Catch errors here.
		{
			// Halt the sharing process.
		}
		
		// Redirect to the email module so the files can be sent. Passing it the destination addresses, the message body,
		// and the array of documentnames and paths.
	} // End function actionShareFiles
	
	/*
	 * Each specific document queue will most likely need its own action to handle each queue's unique requirements.
	 * Those requirements have yet to be determined, so this is just a placeholder for those future actions.
	 */
}
