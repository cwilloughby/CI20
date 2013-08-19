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
 * @property string $type
 * @property string $ext
 * @property string $prefix
 * @property string $description
 * @property string $content
 * @property string $created
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
	public $file;
	public $uploadType;
	
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
		return parent::model($className);
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
		return array(
			array('uploader', 'numerical', 'integerOnly'=>true),
			array('documentname', 'length', 'max'=>45),
			array('path', 'length', 'max'=>100),
			array('type', 'length', 'max'=>45),
			array('ext', 'length', 'max'=>6),
			array('prefix', 'length', 'max'=>10),
			array('modifiedby', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentid, uploader, documentname, path, uploaddate, type, ext, prefix, description, content, created, modifiedby, modifieddate, signed, shareable, disabled', 'safe', 'on'=>'search'),
		);
	} // End of function rules
	
	protected function beforeValidate()
	{
		if($this->isNewRecord)
		{
			// Set the uploader attribute to the current user or set it to a system id if this import is done by a Cron job.
			if(isset(Yii::app()->user->id))
				$this->uploader = Yii::app()->user->id;
			else
				$this->uploader = 0;
			
			// Set the uploaddate attribute to the current date.
			$this->uploaddate = date('Y-m-d_h-i-s');
			
			// Set the path attribute based on the type of upload.
			if($this->uploadType != 'Cron Job')
				$this->path = "\\\\jis18822\\c$\\wamp\\www\\assets\\" . $this->uploadType . "\\" . $this->uploaddate . "\\";
			else
			{
				// To be Determined
			}
			
			// Extract the document name and set the attribute.
			$this->documentname = $this->file['realName'];

			// Create the folder if it does not exist.
			if(!is_dir($this->path))
				mkdir($this->path);

			// Set the path.
			$this->path = $this->path . $this->documentname;
		}
		
		// Return to beforeValidate parent function (required by yii).
		return parent::beforeValidate();
	}
	
	/**
	 * After a file is saved. Log the upload.
	 */
	protected function afterSave()
	{
		// Log the upload.
		$log = new Log;
		$log->tablename = 'ci_documents';
		$log->event = 'Document Uploaded';
		$log->userid = $this->uploader;
		$log->tablerow = $this->documentid;
		$log->save(false);
		
		// Return to afterSave parent function (required by yii).
		return parent::afterSave();
	} // End function afterSave
	
	/**
	 * Determine the model's relationship with other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'documentQueues' => array(self::HAS_MANY, 'DocumentQueues', 'documentid'),
			'uploader0' => array(self::BELONGS_TO, 'UserInfo', 'uploader'),
		);
	} // End function relations

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
			'documentid' => 'Document ID',
			'uploader' => 'Uploader',
			'documentname' => 'Document Name',
			'path' => 'Path',
			'uploaddate' => 'Upload Date',
			'type' => 'File Type',
			'ext' => 'Extension',
			'prefix' => 'Prefix',
			'description' => 'Description',
			'content' => 'Content',
			'created' => 'Created On',
			'modifiedby' => 'Last Modified By',
			'modifieddate' => 'Last Modified On',
			'signed' => 'Signed',
			'disabled' => 'Disabled',
			'shareable' => 'Shareable',
			'file' => 'File',
		);
	} // End function attributeLabels

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// If uploaddate or modifieddate are being searched, convert the date format into the format needed by the database.
		if((int)$this->uploaddate)
			$this->uploaddate = date('Y-m-d', strtotime($this-uploaddate));
		if((int)$this->modifieddate)
			$this->modifieddate = date('Y-m-d', strtotime($this-modifieddate));
		
		// Determine what attributes can be searched and how they can be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('documentid',$this->documentid);
		$criteria->compare('uploader',$this->uploader);
		$criteria->compare('documentname',$this->documentname,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('uploaddate',$this->uploaddate,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ext',$this->ext,true);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('modifiedby',$this->modifiedby,true);
		$criteria->compare('modifieddate',$this->modifieddate,true);
		$criteria->compare('signed',$this->prefix,true);
		$criteria->compare('disabled',$this->description,true);
		$criteria->compare('shareable',$this->content,true);
		
		// Make a dataProvider and return it.
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	} // End function search
	
	/**
	 * This function's main purpose is to determine HOW to read in a
	 * file's contents and metadata. Setting them is the side effect.
	 */
	public function setModelContentsAndMetadata()
	{
		// Get the extension.
		$ext = pathinfo($this->path, PATHINFO_EXTENSION);
		
		switch($ext)
		{
			// If it is a text file.
			case 'txt':
			{
				// Call function to read and set text file contents.
				$this->setTextFileContents();
				break;
			}
			// If it is a word file.
			case 'doc':
			{
				// Call function to read and set word file contents and metadata.
				$this->setWordFileContentsAndMetadata();
				break;
			}
			// If it is an excel file.
			case 'xls':
			{
				// Call function to read and set excel file contents and metadata.
				$this->setExcelFileContentsAndMetadata();
				break;
			}
			// If it is a pdf file.
			case 'pdf':
			{
				// Call function to read and set pdf file contents and metadata.
				$this->setPdfFileContentsAndMetadata();
				break;
			}
			// If it is a tif file
			case 'tif':
			{
				// Call function to read and set file contents and metadata.
				$this->setTifFileContentsAndMetadata();
				break;
			}
			// If it was none of the above.
			default:
			{
				// Set to null.
				$this->content = null;
				break;
			}
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
	public function setTifFileContentsAndMetadata()
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
	 * @return array (documentname => path)
	 */
	public function createArrayAndValidateForFileSharing($requestedFiles)
	{
		// Loop through each file that the user is trying to share.
		foreach($requestedFiles as $file)
		{
			// Double chack that the file that the user is trying to share, is actually shareable.
			if($file->sharable == true)
			{
				// Add the current file's documentname and path to an array.
				$documentsArray = array_merge($documentsArray, array($file->documentname => $file->path));
			}
			else
			{
				// The file is not shareable. Throw an exception.
				throw new Exception($file->documentname . ' is not shareable!');
			}
		}
		
		// return the array of document names and document paths.
		return $documentsArray;
	} // End function createArrayForFileSharing

} // End of class Documents