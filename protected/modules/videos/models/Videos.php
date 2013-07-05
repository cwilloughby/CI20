<?php

/**
 * This is the model class for table "ci_videos".
 *
 * The followings are the available columns in table 'ci_videos':
 * @property integer $videoid
 * @property integer $documentid
 * @property string $title
 * @property string $type
 * @property string $category
 * @property string $poster
 *
 * The followings are the available model relations:
 * @property DocumentProcessor $document
 */
class Videos extends CActiveRecord
{
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
		return 'ci_videos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, type, category, poster', 'required'),
			array('documentid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('type', 'length', 'max'=>45),
			array('category', 'length', 'max'=>45),
			array('poster', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('videoid, documentid, title, type, category, poster', 'safe', 'on'=>'search'),
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
			'document' => array(self::BELONGS_TO, 'Documents', 'documentid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'videoid' => 'ID',
			'documentid' => 'Document',
			'title' => 'Title',
			'type' => 'Type',
			'category' => 'Category',
			'poster' => 'Image',
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

		$criteria->compare('videoid',$this->videoid);
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
}