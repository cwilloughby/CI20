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
 *
 * The followings are the available model relations:
 * @property DocumentProcessor[] $documentProcessors
 * @property UserInfo $uploader0
 */
class Documents extends CActiveRecord
{
	public $attachment;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Documents the static model class
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
		return 'ci_documents';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uploader', 'numerical', 'integerOnly'=>true),
			array('documentname', 'length', 'max'=>45),
			array('path', 'length', 'max'=>100),
			array('attachment', 'file', 'types'=>'jpg, gif, png, txt', 'maxSize'=>'2097152', 'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentid, uploader, documentname, path, uploaddate', 'safe', 'on'=>'search'),
		);
	}
	
	/*
	 * Before the model can be saved, the attributes have to be changed in several different ways.
	 */
	protected function beforeSave()
	{
		if($this->isNewRecord)
		{
			// Set the uploader value to the current user.
			$this->uploader = Yii::app()->user->id;
			// Set the uploaddate and the document name.
			$this->uploaddate = date('Y-m-d_h-i-s');
			$this->documentname = $this->attachment->getName();
			
			// Create a folder with the uploaddate set as the name, unless it already exists.
			$temp = "\\\\CRIM08017\\c$\\wamp\\www\\ci20\\assets\\uploads\\" . $this->uploaddate . "\\";
			if(!is_dir($temp))
				mkdir($temp);

			// Set the path.
			$this->path = $temp . $this->documentname;
			
			// Save the attachment in the server.
			$this->attachment->saveAs($this->path, 'false');
		}
		// Now save a record of the file upload in the database.
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
			'documentProcessors' => array(self::HAS_MANY, 'DocumentProcessor', 'documentid'),
			'uploader0' => array(self::BELONGS_TO, 'UserInfo', 'uploader'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'documentid' => 'Documentid',
			'uploader' => 'Uploader',
			'documentname' => 'Documentname',
			'path' => 'Path',
			'uploaddate' => 'Uploaddate',
			'attachment' => 'Attachment',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('documentid',$this->documentid);
		$criteria->compare('uploader',$this->uploader);
		$criteria->compare('documentname',$this->documentname,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('uploaddate',$this->uploaddate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}