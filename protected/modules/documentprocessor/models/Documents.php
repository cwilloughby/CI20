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
 * @property integer $ext
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
 * @property UserInfo $uploader0
 * @property UserInfo $modifiedby0
 * @property TrainingResources[] $trainingResources
 * @property Videos[] $videoses
 */
class Documents extends CActiveRecord
{
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
			array('uploader, documentname, path, uploaddate', 'required'),
			array('uploader, ext, modifiedby, signed, disabled, shareable', 'numerical', 'integerOnly'=>true),
			array('documentname, type', 'length', 'max'=>45),
			array('path', 'length', 'max'=>100),
			array('prefix', 'length', 'max'=>10),
			array('description, content, modifieddate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('documentid, uploader, documentname, path, uploaddate, type, ext, prefix, description, content, modifiedby, modifieddate, signed, disabled, shareable', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'documentQueues' => array(self::HAS_MANY, 'DocumentQueues', 'documentid'),
			'uploader0' => array(self::BELONGS_TO, 'UserInfo', 'uploader'),
			'modifiedby0' => array(self::BELONGS_TO, 'UserInfo', 'modifiedby'),
			'trainingResources' => array(self::HAS_MANY, 'TrainingResources', 'documentid'),
			'videoses' => array(self::HAS_MANY, 'Videos', 'documentid'),
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
			'type' => 'Type',
			'ext' => 'Ext',
			'prefix' => 'Prefix',
			'description' => 'Description',
			'content' => 'Content',
			'modifiedby' => 'Modifiedby',
			'modifieddate' => 'Modifieddate',
			'signed' => 'Signed',
			'disabled' => 'Disabled',
			'shareable' => 'Shareable',
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
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ext',$this->ext);
		$criteria->compare('prefix',$this->prefix,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('modifiedby',$this->modifiedby);
		$criteria->compare('modifieddate',$this->modifieddate,true);
		$criteria->compare('signed',$this->signed);
		$criteria->compare('disabled',$this->disabled);
		$criteria->compare('shareable',$this->shareable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}