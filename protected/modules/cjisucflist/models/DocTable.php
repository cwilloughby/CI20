<?php

/**
 * This is the model class for table "doc_table".
 *
 * The followings are the available columns in table 'doc_table':
 * @property integer $id
 * @property string $upload_date
 * @property string $name
 * @property string $type
 * @property string $path
 * @property string $extension
 * @property string $uploader
 * @property string $release_num
 * @property string $release_date
 * @property string $agency
 * @property string $cda_num
 * @property string $problem
 * @property string $description
 * @property string $coding_start_date
 * @property string $test_start_date
 * @property string $production_date
 * @property string $documentation_subject
 * @property string $instruction_feature
 */
class DocTable extends CActiveRecord
{
	// This const is the base path that all files uploaded to the server will be saved under.
	const CJIS_FILE_BASE_PATH = 'C:/wamp/files/ucf';
	const CJIS_FILE_BASE_PATH_REMOTE = '\\\\jis18822\\c$\\wamp\\files\\ucf';
	
	// The single search box uses this.
	public $globalSearch;
	
	// This is used to store a file that is being uploaded.
	public $fileUp;
	
	// These two variables are used for posting CJIS news.
	public $buildNum;
	public $features;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocTable the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'doc_table';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('type', 'required', 'on'=>'update'),
			array('fileUp', 'required', 'on'=>'create, cjisNews', 'message'=>'You must provide a file to upload.'),
			array('type', 'required', 'on'=>'create', 'message'=>'Please specify an upload type.'),
			array('buildNum, release_date, features', 'required', 'on'=>'cjisNews'),
			array('fileUp', 'file', 'types'=>'pdf', 'allowEmpty'=>true, 'message'=>'Only files with the pdf extension are allowed.'),
			array('name', 'length', 'max'=>125),
			array('type, uploader, release_num, agency', 'length', 'max'=>45),
			array('path', 'length', 'max'=>200),
			array('extension', 'length', 'max'=>7),
			array('cda_num', 'length', 'max'=>100),
			array('globalSearch','length', 'max'=>70),
			array('release_date, coding_start_date, test_start_date, production_date', 'type', 'type' => 'date', 'message' => '{attribute} must be formatted like MM/DD/YYYY'),
			array('fileUp, release_date, problem, description, coding_start_date, test_start_date, production_date, documentation_subject, instruction_feature', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('upload_date, name, type, path, extension, uploader, release_num, release_date, agency, cda_num, problem, description, coding_start_date, test_start_date, production_date, documentation_subject, instruction_feature', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the upload_date value when a file is uploaded.
	 * @return array containing behaviors.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'upload_date',
				'updateAttribute' => null,
			),
		);
	}
	
	public function beforeSave()
	{
		// Switch the format of the dates to the format used by the database.
		$this->dateFormatter();
		
		// if this is a new record, set the identity of the uploader.
		if($this->isNewRecord)
			$this->uploader = Yii::app()->user->name;
		
		// This loop prevents blank fields from changing nulls in the database to empty strings.
		foreach($this->attributes as $key => $value)
		{
			if(!$value)
				$this->$key = NULL;
		}
		
		return parent::beforeSave();
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'fileUp' => 'Upload File',
			'id' => 'ID',
			'upload_date' => 'Upload Date',
			'name' => 'Name',
			'type' => 'Type',
			'path' => 'Link',
			'extension' => 'Extension',
			'uploader' => 'Uploader',
			'release_num' => 'Release Number',
			'release_date' => 'Release Date',
			'agency' => 'Agency',
			'cda_num' => 'CDA #',
			'problem' => 'Problem',
			'description' => 'Description',
			'coding_start_date' => 'Coding Start Date',
			'test_start_date' => 'Testing Start Date',
			'production_date' => 'Production Date',
			'documentation_subject' => 'Documentation Subject',
			'instruction_feature' => 'Instruction Feature',
			'buildNum' => 'Build Number',
			'features' => 'Features'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$this->dateFormatter();
		$criteria=new CDbCriteria;

		// If something was entered into the single search box.
		if($this->globalSearch)
		{
			$criteria ->addCondition(
				"name LIKE CONCAT('%', :globalSearch , '%') "
				. "OR extension LIKE CONCAT('%', :globalSearch , '%') "
				. "OR type LIKE CONCAT('%', :globalSearch , '%') "
				. "OR agency LIKE CONCAT('%', :globalSearch , '%') "
				. "OR release_num LIKE CONCAT('%', :globalSearch , '%') "
				. "OR release_date LIKE CONCAT('%', :globalSearch , '%') "
				. "OR cda_num LIKE CONCAT('%', :globalSearch , '%') "
				. "OR problem LIKE CONCAT('%', :globalSearch , '%') "
				. "OR description LIKE CONCAT('%', :globalSearch , '%') "
				. "OR coding_start_date LIKE CONCAT('%', :globalSearch , '%') "
				. "OR test_start_date LIKE CONCAT('%', :globalSearch , '%') "
				. "OR production_date LIKE CONCAT('%', :globalSearch , '%') "
				. "OR documentation_subject LIKE CONCAT('%', :globalSearch , '%') "
				. "OR instruction_feature LIKE CONCAT('%', :globalSearch , '%') ");
			$criteria->params = array(':globalSearch' => $this->globalSearch);
		}
		else
		{
			$criteria->compare('upload_date',$this->upload_date,true);
			$criteria->compare('name',$this->name,true);
			$criteria->compare('type',$this->type,true);
			$criteria->compare('path',$this->path,true);
			$criteria->compare('extension',$this->extension,true);
			$criteria->compare('uploader',$this->uploader,true);
			$criteria->compare('release_num',$this->release_num,true);
			$criteria->compare('release_date',$this->release_date,true);
			$criteria->compare('agency',$this->agency,true);
			$criteria->compare('cda_num',$this->cda_num,true);
			$criteria->compare('problem',$this->problem,true);
			$criteria->compare('description',$this->description,true);
			$criteria->compare('coding_start_date',$this->coding_start_date,true);
			$criteria->compare('test_start_date',$this->test_start_date,true);
			$criteria->compare('production_date',$this->production_date,true);
			$criteria->compare('documentation_subject',$this->documentation_subject,true);
			$criteria->compare('instruction_feature',$this->instruction_feature,true);
		}
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Convert the supplied dates, if any, to the format recognized by the database.
	 */
	public function dateFormatter()
	{
		if((int)$this->upload_date)
			$this->upload_date = date('Y-m-d', strtotime($this->upload_date));
		if((int)$this->release_date)
			$this->release_date = date('Y-m-d', strtotime($this->release_date));
		if((int)$this->coding_start_date)
			$this->coding_start_date = date('Y-m-d', strtotime($this->coding_start_date));
		if((int)$this->test_start_date)
			$this->test_start_date = date('Y-m-d', strtotime($this->test_start_date));
		if((int)$this->production_date)
			$this->production_date = date('Y-m-d', strtotime($this->production_date));
	}
	
	/**
	 * The actual file upload occurs here.
	 */
	public function uploadFile()
	{
		$this->name = $this->fileUp->name;
		$this->setPath();
		$this->fileUp->saveAs($this->path);
	}
	
	/**
	 * Select the correct save path dependinbg on if the user is in development or production.
	 */
	private function setPath()
	{
		// Set the uploaddate attribute to the current date.
		$uploaddate = date('Y-m-d_h-i-s');
		
		if(($_SERVER['REMOTE_ADDR'] != "127.0.0.1"))
		{
			$this->path = self::CJIS_FILE_BASE_PATH_REMOTE . "\\" . $uploaddate;
			
			// Create the folder if it does not exist.
			if(!is_dir($this->path))
				mkdir($this->path, 0777, true);
			
			$this->path = $this->path . "\\" . $this->name;
		}
		else
		{
			$this->path = self::CJIS_FILE_BASE_PATH . "/" . $uploaddate;
			
			// Create the folder if it does not exist.
			if(!is_dir($this->path))
				mkdir($this->path, 0777, true);
			
			$this->path = $this->path . "/" . $this->name;
		}

	}
}
