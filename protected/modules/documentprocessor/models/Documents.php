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
 * @property integer $modifiedby
 * @property string $modifieddate
 * @property integer $signed
 * @property integer $disabled
 * @property integer $shareable
 *
 * The followings are the available model relations:
 * @property DocumentQueues[] $documentQueues
 * @property UserInfo $modifiedby0
 * @property UserInfo $uploader0
 */
class Documents extends CActiveRecord
{
	const FILE_BASE_PATH = 'C:/wamp/files';
	
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
			array('uploader, modifiedby', 'numerical', 'integerOnly'=>true),
			array('documentname', 'length', 'max'=>45),
			array('path', 'length', 'max'=>100),
			array('type', 'length', 'max'=>45),
			array('ext', 'length', 'max'=>6),
			array('prefix', 'length', 'max'=>10),
			array('modifiedby', 'length', 'max'=>45),
			array('ext', 'validExt', 'on' => 'averageSubmit'),
			array('ext', 'validTrainingResource', 'on' => 'trainingSubmit'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentid, uploader, documentname, path, uploaddate, type, ext, prefix, description, content, modifiedby, modifieddate, signed, shareable, disabled', 'safe', 'on'=>'search'),
		);
	} // End of function rules
	
	/**
	 * This validation rule is used for most file submissions, 
	 * @param type $attribute
	 */
	public function validExt($attribute)
	{
		if(!in_array($this->$attribute, array('pdf', 'doc', 'docx', 'xls', 'tif', 'tiff', 'jpg', 'png', 'bmp', 'txt')))
			$this->addError($this->$attribute, 'only pdf, doc, docx, xls, tif, jpg, png, bmp, or txt files are allowed!');
	}
	
	public function validTrainingResource($attribute)
	{
		if(!in_array($this->$attribute, array('pdf', 'mp4', 'htm', 'png', 'css')))
			$this->addError($this->$attribute, 'only pdf, mp4, htm, png, or css files are allowed!');
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the opendate value
	 * when a new ticket is made.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => null,
				'updateAttribute' => 'modifieddate',
			),
		);
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
			'modifiedby0' => array(self::BELONGS_TO, 'UserInfo', 'modifiedby'),
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
		$criteria->compare('modifiedby',$this->modifiedby);
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
	 * Normal attribute assignment method won't work, so this function is used.
	 */
	public function setDocumentAttributes()
	{
		// Set the uploader attribute to the current user or set it to a system id if this import is done by a Cron job.
		if(isset(Yii::app()->user->id))
			$this->uploader = Yii::app()->user->id;
		else
			$this->uploader = 0;

		// Set the uploaddate attribute to the current date.
		$this->uploaddate = date('Y-m-d_h-i-s');
		// Set the extension.
		$this->ext = pathinfo($this->file['realName'], PATHINFO_EXTENSION);
		
		// Set the path attribute based on the type of upload.
		if($this->uploadType != 'Cron Job' && $this->uploadType != 'training resource')
		{
			//$this->path = "\\\\jis18822\\c$\\wamp\\www\\assets\\" . $this->uploadType . "\\" . $this->uploaddate . "\\";
			$this->path = self::FILE_BASE_PATH . "/uploads/" . $this->uploaddate . "/";
		}
		else if($this->uploadType == 'training resource')
		{
			$this->path = self::FILE_BASE_PATH . "/training/";
		}
		else
		{
			// To be Determined
		}

		// Extract the document name and set the attribute.
		$this->documentname = $this->file['realName'];
	}
	
	/**
	 * This function is where a file is actually uploaded to the server.
	 */
	public function uploadFile()
	{
		// Create the folder if it does not exist.
		if(!is_dir($this->path))
			mkdir($this->path);

		// Set the path.
		$this->path = $this->path . $this->documentname;
		
		move_uploaded_file($this->file['tempName'], $this->path);
	}
	
	/**
	 * This function's main purpose is to determine HOW to read in a
	 * file's contents and metadata. Setting them is the side effect.
	 */
	public function setModelContentsAndMetadata()
	{
		// Set the metadata.
		$this->modifieddate = date('Y-m-d_h-i-s');
		$this->type = 'file';
		if(isset(Yii::app()->user->id))
			$this->modifiedby = Yii::app()->user->id;
		
		switch($this->ext)
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
				$this->setWordFileContents();
				break;
			}
			case 'docx':
			{
				// Call function to read and set word file contents and metadata.
				$this->setWordFileContents();
				break;
			}
			// If it is an excel file.
			case 'xls':
			{
				// Call function to read and set excel file contents and metadata.
				$this->setExcelFileContents();
				break;
			}
			// If it is a pdf file.
			case 'pdf':
			{
				// Call function to read and set pdf file contents and metadata.
				$this->setPdfFileContents();
				break;
			}
			// If it is a tif file
			case 'tif':
			{
				// Call function to read and set file contents and metadata.
				$this->setTifFileContents();
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
		// Read in the contents of the text file and give it to the model’s content attribute.
		$this->content = file_get_contents($this->path);
	} // End function setTextFileContents()

	/**
	 * This function is for reading in the content of a word document,
	 * then setting the model’s content attribute to that content. It also reads in the file’s
	 * modified by, and modified date metadata
	 */
	public function setWordFileContents()
	{
		// Open the word document for reading.
		$word = new COM("word.application") or die ("Could not initialise MS Word object.");
		$word->Documents->Open(realpath($this->path));
		
		// Read in the contents of the word document and give it to the model’s content attribute.
		$this->content = preg_replace("/[^A-Za-z0-9 ]/", "", (string)$word->ActiveDocument->Content); 
		
		// Close the word document and clean up.
		$word->ActiveDocument->Close(false);
		$word->Quit();
		$word = null;
		unset($word);
	} // End function setWordFileContentsAndMetadata

	/**
	 * This function is for reading in the content of an excel document,
	 * then setting the model’s content attribute to that content. It also reads in the file’s
	 * modified by, and modified date metadata
	 */
	public function setExcelFileContents()
	{
		// Read the contents of the excel file into an array.
		$sheetArray = Yii::app()->yexcel->readActiveSheet($this->path);

		foreach($sheetArray as $row)
		{
			// Read in the contents of the excel document and give it to the model’s content attribute.
			foreach($row as $column)
				$this->content .= $column . " ";
		}
	} // End function setExcelFileContentsAndMetadata
	
	/**
	 * This function is for reading in the content of a Pdf document,
	 * then setting the model’s content attribute to that content.
	 */
	public function setPdfFileContents()
	{
		// Open the pdf document for reading.
		$a = new PDF2Text();
		$a->setFilename($this->path);
		$a->decodePDF();
	
		// If the pdf is already readable, then we don't need to perform OCR.
		if($a->output())
		{
			// Read in the contents of the pdf document and give it to the model’s content attribute.
			$this->content = $a->output(); 
		}
		else 
		{
			// OCR conversion here.
			// Read in the contents of the pdf document and give it to the model’s content attribute.
			$tess = new TesseractOCR();
			$this->content = $tess->convertToText($this->path);
		}

	} // End function setPdfFileContentsAndMetadata
	
	/**
	 * This function is for reading in the content of a Tiff document,
	 * then setting the model’s content attribute to that content.
	 */
	public function setTifFileContents()
	{
		// OCR conversion here.
		// Read in the contents of the tiff document and give it to the model’s content attribute.
		$tess = new TesseractOCR();
		$this->content = $tess->convertToText($this->path);
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