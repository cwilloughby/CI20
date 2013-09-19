<?php

/**
 * This class is for the document upload widget. 
 */
class DocumentUploadWidget extends CPortlet 
{
	// Make a class variable that will be used to determine where a file should be stored.
	// (A document queue, or the training page for example.)
	public $uploadType;
	public $viewPath = '/views';
	
	/**
	 * This routine is for displaying the file upload form.
	 * I know this name does not follow best practice, but it is required this way by yii.
	 * A better name would be displayUploadFormAndValidate()
	 */
    protected function renderContent()
	{
		try
		{
			// If the form was posted.
			if(!empty($_FILES)) 
			{
				// Forward to the documentprocessorcontroller's upload action.
				$_GET['uploadType'] = $this->uploadType;
				$this->controller->forward('documentprocessor/documentprocessor/upload');
			} // End if

			// Create Document model object.
			$document = new Documents;
			
			// Call view to render the upload form.
			$this->render('uploadForm', array(
				'document' => $document,
			));
		}
		catch(Exception $ex)
		{
			echo "Document upload form failed with error " . $ex;
		}
    } // End function renderContent
} // End of class DocumentUploadWidget
