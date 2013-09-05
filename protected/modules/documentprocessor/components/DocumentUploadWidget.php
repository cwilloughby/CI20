<?php

/**
 * This class is for the document upload widget. 
 */
class DocumentUploadWidget extends CPortlet 
{
	// Make a class variable that will be used to determine where a file should be stored.
	// (A document queue, or the training page for example.)
	public $uploadType;
	
	/**
	 * This routine is for displaying the file upload form and processing the uploaded file.
	 * I know this name does not follow best practice, but it is required this way by yii.
	 * A better name would be displayUploadFormAndValidate()
	 */
    protected function renderContent()
	{
		// Create Document model object.
		$document = new Documents;
		$document->scenario = 'averageSubmit';
		$document->uploadType = $this->uploadType;
		
		// If the form was posted.
		if(!empty($_FILES)) 
		{	
			$document = $this->storeFile($document);
		} // End if

		// Call view to render the upload form.
		$this->render('uploadForm', array(
			'document' => $document,
		));
    } // End function renderContent
	
	private function storeFile($document)
	{
		// Read in the current file.
		$document->file = array('tempName' => $_FILES['file']['tmp_name'], 'realName' => $_FILES['file']['name']);
		$document->setDocumentAttributes();

		// Validate attributes.
		if($document->validate())
		{
			// Upload file to server.
			$document->uploadFile();

			// Call function to read the file’s content and metadata.
			$document->setModelContentsAndMetadata();

			// Save Document Model
			$document->save(false);

			// If the type of upload is for a document queue.
			if($this->uploadType == 'QueueName')
			{
				// Create DocumentQueues model object.

				// Pass documentid of newly uploaded file to document queue model.

				// Pass name of queue to document queue model.

				// Save DocumentQueues Model.
			}
		}
		return $document;
	}
} // End of class DocumentUploadWidget
