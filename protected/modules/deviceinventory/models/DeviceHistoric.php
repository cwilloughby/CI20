<?php

/**
 * This is the model class for table "ci_device_historic".
 *
 * The followings are the available columns in table 'ci_device_historic':
 * @property integer $deviceid
 * @property string $datechanged
 * @property string $username
 * @property string $location
 *
 * The followings are the available model relations:
 * @property DeviceInventory $device
 */
class DeviceHistoric extends CActiveRecord
{
	// These variables are used to look up meaningful values of foreign keys.
	public $device_search;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeviceHistoric the static model class
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
		return 'ci_device_historic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('deviceid', 'required'),
			array('deviceid', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>25),
			array('location', 'length', 'max'=>200),
			array('location', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('deviceid, device_search, datechanged, username, location', 'safe', 'on'=>'search'),
		);
	}

	public function behaviors()
	{
		return array(
			'SearchSaver'=>array(
				'class'=>'application.components.SearchSaver',
			),
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
			'device' => array(self::BELONGS_TO, 'DeviceInventory', 'deviceid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'deviceid' => 'Device ID',
			'device_search' => 'Device',
			'datechanged' => 'Date Assigned',
			'username' => 'Username',
			'location' => 'Location',
		);
	}

	protected function afterFind()
	{
		// Set the format for the dates to mm/dd/YYYY before displaying it.
		$this->dateFormatter("m/d/Y");
		return parent::afterFind();
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		// If datechanged is being searched, convert the date format into the format needed by the database.
		$this->dateFormatter("Y-m-d");
		// Set the database relation.
		$criteria->with = array('device');
				
		$criteria->compare('t.deviceid',$this->deviceid);
		$criteria->compare('device.devicename',$this->device_search,true);
		$criteria->compare('datechanged',$this->datechanged,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('location',$this->location,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'user_search'=>array(
						'asc'=>'device.devicename',
						'desc'=>'device.devicename DESC',
					),
				),
			),
		));
	}
	
	/**
	 * Convert the supplied date to the desired format.
	 * @param string $format contains the date format that you want all of the model dates converted to.
	 */
	public function dateFormatter($format)
	{
		if((int)$this->datechanged)
			$this->datechanged = date($format, strtotime($this->datechanged));
	}
}