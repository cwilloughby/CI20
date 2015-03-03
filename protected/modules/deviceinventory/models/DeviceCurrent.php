<?php

/**
 * This is the model class for table "ci_device_current".
 *
 * The followings are the available columns in table 'ci_device_current':
 * @property integer $deviceid
 * @property string $datechanged
 * @property string $username
 * @property string $location
 *
 * The followings are the available model relations:
 * @property DeviceInventory $device
 */
class DeviceCurrent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeviceCurrent the static model class
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
		return 'ci_device_current';
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
			array('deviceid, datechanged, username, location', 'safe', 'on'=>'search'),
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
			'datechanged' => 'Date Assigned',
			'username' => 'Username',
			'location' => 'Location',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('deviceid',$this->deviceid);
		$criteria->compare('datechanged',$this->datechanged,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('location',$this->location,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}