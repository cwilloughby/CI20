<?php

/**
 * This is the model class for table "ci_time_log".
 *
 * The followings are the available columns in table 'ci_time_log':
 * @property integer $id
 * @property string $username
 * @property string $computername
 * @property string $eventtype
 * @property string $eventtime
 * @property string $eventdate
 */
class TimeLog extends CActiveRecord
{
	// These two variables are for date range searches.
	public $from_date;
	public $to_date;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TimeLog the static model class
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
		return 'ci_time_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('computername', 'length', 'max'=>15),
			array('eventtype', 'length', 'max'=>7),
			array('eventtime, eventdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, computername, eventtype, eventtime, eventdate, from_date, to_date', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'computername' => 'Computername',
			'eventtype' => 'Event Type',
			'eventtime' => 'Event Time',
			'eventdate' => 'Event Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->group = 'username, computername, eventdate, eventtype, eventtime';
		
		if(!empty($this->from_date) && empty($this->to_date))
        {
			// date is database date column field
            $criteria->condition = "eventdate >= '$this->from_date'";  
        }
		else if(!empty($this->to_date) && empty($this->from_date))
        {
            $criteria->condition = "eventdate <= '$this->to_date'";
        }
		else if(!empty($this->to_date) && !empty($this->from_date))
        {
            $criteria->condition = "eventdate  >= '$this->from_date' and eventdate <= '$this->to_date'";
        }
		
		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('computername',$this->computername,true);
		$criteria->compare('eventtype',$this->eventtype,true);
		$criteria->compare('eventtime',$this->eventtime,true);
		$criteria->compare('eventdate',$this->eventdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder' => 'username, computername, eventdate, eventtime',
				'attributes'=>array(
					'username'=>array(
						'asc'=>'username, computername, eventdate, eventtime',
						'desc'=>'username DESC, computername, eventdate, eventtime',
					),
					'computername'=>array(
						'asc'=>'computername, username, eventdate, eventtime',
						'desc'=>'computername DESC, username, eventdate, eventtime',
					),
					'eventdate'=>array(
						'asc'=>'eventdate, username, computername, eventtime',
						'desc'=>'eventdate DESC, username, computername, eventtime',
					),
					'eventtype'=>array(
						'asc'=>'eventtype, username, computername, eventdate, eventtime',
						'desc'=>'eventtype DESC, username, computername, eventdate, eventtime',
					),
					'eventtime'=>array(
						'asc'=>'eventtime, username, computername, eventdate',
						'desc'=>'eventtime DESC, username, computername, eventdate',
					),
					'*',
				),
			),
		));
	}
}