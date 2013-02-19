<?php

/**
 * This is the model class for table "ci_news".
 *
 * The followings are the available columns in table 'ci_news':
 * @property integer $newsid
 * @property integer $typeid
 * @property integer $postedby
 * @property string $date
 * @property string $news
 *
 * The followings are the available model relations:
 * @property NewsType $type
 * @property UserInfo $postedby0
 */
class News extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return 'ci_news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('typeid, postedby, date, news', 'required'),
			array('typeid, postedby', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('newsid, typeid, postedby, date, news', 'safe', 'on'=>'search'),
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
			'type' => array(self::BELONGS_TO, 'NewsType', 'typeid'),
			'postedby0' => array(self::BELONGS_TO, 'UserInfo', 'postedby'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'newsid' => 'News ID',
			'typeid' => 'Type ID',
			'postedby' => 'Posted By',
			'date' => 'Date',
			'news' => 'News',
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

		$criteria->compare('newsid',$this->newsid);
		$criteria->compare('typeid',$this->typeid);
		$criteria->compare('postedby',$this->postedby);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('news',$this->news,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}