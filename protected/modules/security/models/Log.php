<?php

/**
 * This is the model class for table "ci_log".
 *
 * The followings are the available columns in table 'ci_log':
 * @property integer $eventid
 * @property integer $userid
 * @property string $tablename
 * @property string $tablerow
 * @property string $eventdate
 * @property string $event
 *
 * The followings are the available model relations:
 * @property UserInfo $user
 */
class Log extends CActiveRecord
{
	public $user_search;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Log the static model class
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
		return 'ci_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, tablename, tablerow, event', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('tablename, tablerow, eventdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('eventid, userid, user_search, tablename, tablerow, eventdate, event', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'UserInfo', 'userid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'eventid' => 'Event ID',
			'userid' => 'User',
			'user_search' => 'User',
			'tablename' => 'Table Name',
			'tablerow' => 'Table Row',
			'eventdate' => 'Event Date',
			'event' => 'Event',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('user');
					
		if((int)$this->eventdate)
			$this->eventdate = date('Y-m-d', strtotime($this->eventdate));
		
		$criteria->compare('eventid',$this->eventid);
		$criteria->compare('user.username',$this->user_search,true);
		$criteria->compare('tablename',$this->tablename,true);
		$criteria->compare('tablerow',$this->tablerow,true);
		$criteria->compare('eventdate',$this->eventdate,true);
		$criteria->compare('event',$this->event,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'user_search'=>array(
						'asc'=>'user.username',
						'desc'=>'user.username DESC',
					),
					'*',
				),
			),
		));
	}
}