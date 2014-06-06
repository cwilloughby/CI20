<?php

/**
 * This is the model class for table "ci_training_resources".
 *
 * The followings are the available columns in table 'ci_training_resources':
 * @property integer $resourceid
 * @property integer $documentid
 * @property string $title
 * @property string $type
 * @property string $category
 * @property string $poster
 *
 * The followings are the available model relations:
 * @property DocumentProcessor $document
 */
class TrainingResources extends CActiveRecord
{
	// This const is the base path that all images uploaded to the server will be saved under.
	const TRAINING_IMAGE_BASE_PATH = 'C:/wamp/files/images';
	const TRAINING_IMAGE_BASE_PATH_REMOTE = '\\\\jis18822\\c$\\wamp\\files\\images';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Videos the static model class
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
		return 'ci_training_resources';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('title, type, category, poster', 'required'),
			array('documentid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('type', 'length', 'max'=>45),
			array('category', 'length', 'max'=>45),
			array('poster', 'file', 'types'=>'jpg, png, bmp', 'allowEmpty'=>true, 'message'=>'Only images with an extension of jpg, png, or bmp are allowed.'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('resourceid, documentid, title, type, category, poster', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'document' => array(self::BELONGS_TO, 'Documents', 'documentid'),
		);
	}

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
			'resourceid' => 'ID',
			'documentid' => 'Document',
			'title' => 'Title',
			'type' => 'Type',
			'category' => 'Category',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('resourceid',$this->resourceid);
		$criteria->compare('documentid',$this->documentid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('poster',$this->poster,true);
		
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * The actual image upload occurs here.
	 */
	public function uploadImage()
	{
		try
		{
			$pathInfo = $this->setPath();
			$this->poster->saveAs($pathInfo['FilePath']);
			$this->poster = $pathInfo['WebPath'];
		}
		catch(Exception $ex)
		{
			throw new CHttpException(500, 'An unexpected error occurred while uploading the image. Error: ' . $ex);
		}
	}
	
	/**
	 * Select the correct save path depending on if the user is in development or production.
	 * @return String path
	 */
	private function setPath()
	{
		// Set the uploaddate attribute to the current date for use as a folder name.
		$uploaddate = date('Y-m-d_h-i-s');
		
		// Remote upload location for production.
		if(($_SERVER['REMOTE_ADDR'] != "127.0.0.1"))
		{
			$pathInfo['FilePath'] = self::TRAINING_IMAGE_BASE_PATH_REMOTE . "\\" . $uploaddate;
			
			// Create the folder if it does not exist.
			if(!is_dir($pathInfo['FilePath']))
				mkdir($pathInfo['FilePath'], 0777, true);
			
			$pathInfo['FilePath'] = $pathInfo['FilePath'] . "\\" . $this->poster->name;
		}
		// Local upload location for development.
		else
		{
			$pathInfo['FilePath'] = self::TRAINING_IMAGE_BASE_PATH . "/" . $uploaddate;
			
			// Create the folder if it does not exist.
			if(!is_dir($pathInfo['FilePath']))
				mkdir($pathInfo['FilePath'], 0777, true);
			
			$pathInfo['FilePath'] = $pathInfo['FilePath'] . "/" . $this->poster->name;
		}
		// Webpath will be used to view the image on the webpage.
		$pathInfo['WebPath'] = "/files/images/" . $uploaddate . "/" . $this->poster->name;
		return $pathInfo;
	}
}