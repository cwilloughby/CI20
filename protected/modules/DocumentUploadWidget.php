<?php

/**
 * This class is for the document upload widget. 
 */
class DocumentUploadWidget extends CPortlet 
{
	// Make a class variable that will be used to determine where a file should be stored.
	// (A document queue, or the training page for example.)
	
	/**
	 * This routine is for displaying the file upload form and processing the uploaded file.
	 * I know this name does not follow best practice but it is required this way by yii.
	 * A better name would be displayUploadFormAndValidate()
	 */
    protected function renderContent()
	{
		// Create Document model object.

		// If the form was posted.
		{
			// Loop for multiple files
			{
				// Read in the current file.

				// Call function to read the file’s content and metadata.
				
				// Validate attributes.

				// Save Document Model
				
				// If the type of upload is for a document queue.
				{
					// Create DocumentQueues model object.
					
					// Pass documentid of newly uploaded file to document queue model.
					
					// Pass name of queue to document queue model.
					
					// Save DocumentQueues Model.
				}
				
				// Upload file to server.
			} // End loop
		}

		// Call view to render the upload form.
    } // End function renderContent
	
} // End of class DocumentUploadWidget
