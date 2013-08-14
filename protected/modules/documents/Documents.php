<?php

/**
 * This is the model class for table "ci_documents".
 *
 * The followings are the available columns in table 'ci_documents':
 * @property integer $documentid
 * @property integer $uploader
 * @property string $documentname
 * @property string $path
 * @property string $uploaddate
 * @property string $prefix
 * @property string $description
 * @property string $content
 * @property string $modifieddate
 * @property string $modifiedby
 * @property integer $signed
 * @property integer $disabled
 * @property integer $shareable
 *
 * The followings are the available model relations:
 * @property DocumentQueues[] $documentQueues
 * @property UserInfo $uploader0
 */
class Documents extends CActiveRecord
{
	// Make a class variable that will be used to temporarily store the file.
	
	/**
	 * Returns the static model of the specified AR class.
	 * I know this name does not follow best practice, but it is required this way by yii.
	 * A better name would be getModel()
	 * @param string $className active record class name.
	 * @return Documents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		// Return the model name.
	} // End of function model

	/** 
	 * I know this name does not follow best practice, but it is required this way by yii.
	 * A better name would be getTableName()
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ci_documents';
	} // End of function tableName

	/**
	 * I know this name does not follow best practice, but it is required this way by yii.
	 * A better name would be setValidationRules()
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
	} // End of function rules
	
	/**
	 * Before the model can be validated, many attributes need to be autoset.
	 */
	protected function beforeValidate()
	{
		// Set the uploader attribute to the current user or set it to a system id if this import is done by a Cron job.

		// Set the uploaddate attribute to the current date.
		
		// Extract the document name and set the attribute.
		
		// Set the path attribute based on the type of upload.
		
		// Return to beforeValidate parent function (required by yii).
	} // End function beforeValidate
	
	/**
	 * After a file is saved. Log the upload
	 */
	protected function afterSave()
	{
		// Log the upload.
		
		// Return to afterSave parent function (required by yii).
	} // End function afterSave
	
	/**
	 * Determine the model's relationship with other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
	} // End function relations

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
	} // End function attributeLabels

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Determine what attributes can be searched and how they can be searched.
		
		// Make a dataProvider and return it.
	} // End function search
	
	/**
	 * This function's main purpose is to determine HOW to read in a
	 * file's contents and metadata. Setting them is the side effect.
	 */
	public function setModelContentsAndMetadata()
	{
		// If it is a text file.
		{
			// Call function to read and set text file contents.
		}
		// If it is a word file.
		{
			// Call function to read and set word file contents and metadata.
		}
		// If it is an excel file.
		{
			// Call function to read and set excel file contents and metadata.
		}
		// If it is a pdf file.
		{
			// Call function to read and set pdf file contents and metadata.
		}
		// If it is a tiff file
		{
			// Call function to read and set file contents and metadata.
		}
		// If it was none of the above.
		{
			// Set to null.
		}
	} // End function setFileContentsAndMetadata

	/**
	 * This function is for reading in the content of a text file,
	 * then setting the model’s content attribute to that content.
	 */
	public function setTextFileContents()
	{
		// Open the text file for reading.

		// Read in the contents of the text file and give it to the model’s content attribute.

		// Close the text file.
	} // End function setTextFileContents()

	/**
	 * This function is for reading in the content of a word document,
	 * then setting the model’s content attribute to that content. It also reads in the file’s
	 * modified by, and modified date metadata
	 */
	public function setWordFileContentsAndMetadata()
	{
		// Open the word document for reading.

		// Read in the modified by metadata and give it to the model’s modifiedby attribute.	

		// Read in the modified date metadata and give it to the model’s modifieddate attribute.

		// Read in the contents of the word document and give it to the model’s content attribute.

		// Close the word document.
	} // End function setWordFileContentsAndMetadata

	/**
	 * This function is for reading in the content of an excel document,
	 * then setting the model’s content attribute to that content. It also reads in the file’s
	 * modified by, and modified date metadata
	 */
	public function setExcelFileContentsAndMetadata()
	{
		// Open the excel document for reading.

		// Read in the modified by metadata and give it to the model’s modifiedby attribute.	

		// Read in the modified date metadata and give it to the model’s modifieddate attribute.

		// Read in the contents of the excel document and give it to the model’s content attribute.

		// Close the excel document.
	} // End function setExcelFileContentsAndMetadata
	
	/**
	 * This function is for reading in the content of a Pdf document,
	 * then setting the model’s content attribute to that content. It also reads in the file’s
	 * modified by, and modified date metadata
	 */
	public function setPdfFileContentsAndMetadata()
	{
		// Open the pdf document for reading.

		// Read in the modified by metadata and give it to the model’s modifiedby attribute.	

		// Read in the modified date metadata and give it to the model’s modifieddate attribute.

		// OCR conversion here.
		
		// Read in the contents of the pdf document and give it to the model’s content attribute.

		// Close the pdf document.
	} // End function setPdfFileContentsAndMetadata
	
	/**
	 * This function is for reading in the content of a Tiff document,
	 * then setting the model’s content attribute to that content. It also reads in the file’s
	 * modified by, and modified date metadata
	 */
	public function setTiffFileContentsAndMetadata()
	{
		// Open the tiff document for reading.

		// Read in the modified by metadata and give it to the model’s modifiedby attribute.	

		// Read in the modified date metadata and give it to the model’s modifieddate attribute.
		
		// OCR conversion here.
		
		// Read in the contents of the tiff document and give it to the model’s content attribute.

		// Close the tiff document.
	} // End function setTiffFileContentsAndMetadata
	
	/**
	 * Create an array containing documentname and documentpath of the requested files,
	 * as long as those files are shareable.
	 * @return array (documentname => documentpath)
	 */
	public function createArrayAndValidateForFileSharing($requestedFiles)
	{
		// Loop for each file that the user is trying to share
		{
			// Double chack that the file that the user is trying to share, is actually shareable.
			{
				// Add the current file's documentname and path to an array.
			}
			// Else
			{
				// One or more of the files is not shareable. Throw an exception.
			}
		}
		
		// return the array of document names and document paths.
	} // End function createArrayForFileSharing

} // End of class Documents