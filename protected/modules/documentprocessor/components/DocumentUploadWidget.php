<?php

/**
 * This class is for the document upload widget. 
 */
class DocumentUploadWidget extends CPortlet 
{
	// Make a class variable that will be used to determine where a file should be stored.
	// (A document queue, or the training page for example.)
	public $type;
	
	/**
	 * This routine is for displaying the file upload form and processing the uploaded file.
	 * I know this name does not follow best practice, but it is required this way by yii.
	 * A better name would be displayUploadFormAndValidate()
	 */
    protected function renderContent()
	{
		// Create Document model object.
		$document = new Documents;
		$document->scenario = 'processor';
		$document->type = $this->type;
		
		// If the form was posted.
		if(!empty($_FILES)) 
		{	
			// Loop for multiple files
			{
				// Read in the current file.
				$document->file = array('tempName' => $_FILES['file']['tmp_name'], 'realName' => $_FILES['file']['name']);
				
				// Call function to read the file’s content and metadata.
				$document->setModelContentsAndMetadata();
				
				// Validate attributes.
				if($document->validate())
				{
					// Save Document Model
					$document->save(false);
					
					// Upload file to server.
					if($this->type != 'Common')
						move_uploaded_file($document->file['tempName'], $document->path);
					
					// If the type of upload is for a document queue.
					if($this->type == 'QueueName')
					{
						// Create DocumentQueues model object.

						// Pass documentid of newly uploaded file to document queue model.

						// Pass name of queue to document queue model.

						// Save DocumentQueues Model.
					}
				}
			} // End loop
		} // End if

		// Call view to render the upload form.
		$this->render('uploadForm', array(
			'document' => $document,
		));
    } // End function renderContent
	
} // End of class DocumentUploadWidget
