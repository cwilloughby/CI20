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
	public $type_search;
	public $user_search;
	
	// These three variables are used for posting CJIS news.
	public $buildNum;
	public $releaseDate;
	public $features;
	
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
		// Define the validation rules in an array and return it.
		return array(
			array('typeid, news', 'required'),
			array('buildNum, releaseDate, features', 'required', 'on'=>'cjisNews'),
			array('typeid, postedby', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('newsid, user_search, type_search, typeid, postedby, date, news', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the date value when a news post is made.
	 * @return array containing behaviors.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'date',
				'updateAttribute' => null,
			),
		);
	}
	
	/**
	 * Sets the postedby value to the person who created the news post.
	 */
	protected function beforeSave()
	{
		if(null !== Yii::app()->user)
			$id=Yii::app()->user->id;
		else
			$id=1;

		if($this->isNewRecord)
			$this->postedby=$id;

		return parent::beforeSave();
	}
	
	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'type' => array(self::BELONGS_TO, 'NewsType', 'typeid'),
			'postedby0' => array(self::BELONGS_TO, 'UserInfo', 'postedby'),
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
			'newsid' => 'News ID',
			'typeid' => 'Type',
			'type_search' => 'Type',
			'postedby' => 'Posted By',
			'user_search' => 'Posted By',
			'date' => 'Date',
			'news' => 'News',
			'buildNum' => 'Build Number',
			'releaseDate' => 'Release Date',
			'features' => 'Features'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		
		if((int)$this->date)
			$this->date = date('Y-m-d', strtotime($this->date));
				
		$criteria->compare('newsid',$this->newsid);
		$criteria->compare('typeid',$this->typeid);
		$criteria->compare('type.type',$this->user_search,true);
		$criteria->compare('postedby',$this->postedby);
		$criteria->compare('postedby0.username',$this->user_search,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('news',$this->news,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>array(
					'date'=>CSort::SORT_DESC,
				),
			),
		));
	}
}