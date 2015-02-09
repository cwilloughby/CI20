<?php

/**
 * This is the model class for table "ci_device_inventory".
 *
 * The followings are the available columns in table 'ci_device_inventory':
 * @property integer $deviceid
 * @property string $username
 * @property integer $extension
 * @property string $model
 * @property string $devicename
 * @property string $warrentyenddate
 * @property string $revolvedate
 * @property string $comments
 * @property string $location
 * @property string $serial
 * @property string $url
 * @property string $equipmenttype
 * @property integer $enabled
 * @property string $indate
 * @property string $outdate
 */
class DeviceInventory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DeviceInventory the static model class
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
		return 'ci_device_inventory';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('model, devicename', 'required'),
			array('extension, enabled', 'numerical', 'integerOnly'=>true),
			array('enabled', 'in', 'range'=>array(0,1), 'message' => '{attribute} must be either Yes or No'),
			array('username, model, serial, equipmenttype', 'length', 'max'=>45),
			array('serial', 'length', 'max'=>30),
			array('devicename', 'length', 'max'=>30),
			array('location', 'length', 'max'=>200),
			array('url', 'length', 'max'=>500),
			array('warrentyenddate, revolvedate, indate, outdate', 'type', 'type' => 'date', 'message' => '{attribute} must be formatted like m/d/yyyy', 'dateFormat' => 'M/d/yyyy'),
			array('warrentyenddate, revolvedate, comments, indate, outdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('deviceid, username, extension, model, devicename, warrentyenddate, revolvedate, comments, location, serial, url, equipmenttype, enabled, indate, outdate', 'safe', 'on'=>'search'),
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
			'deviceid' => 'Device ID',
			'username' => 'Username',
			'extension' => 'Extension',
			'model' => 'Model',
			'devicename' => 'Device Name',
			'warrentyenddate' => 'Warrenty End Date',
			'revolvedate' => 'Revolve Date',
			'comments' => 'Comments',
			'location' => 'Location',
			'serial' => 'Serial',
			'url' => 'URL',
			'equipmenttype' => 'Equipment Type',
			'enabled' => 'Enabled',
			'indate' => 'In Date',
			'outdate' => 'Out Date',
		);
	}

	protected function afterFind()
	{
		// Set the format for the dates to mm/dd/YYYY before displaying it.
		$this->dateFormatter("m/d/Y");
		return parent::afterFind();
	}
	
	public function beforeSave()
	{
		// This loop prevents blank fields from changing nulls in the database to empty strings.
		foreach($this->attributes as $key => $value)
		{
			if(!$value)
				$this->$key = NULL;
		}
		
		// Set the format for the dates back to YYYY-mm-dd before saving.
		$this->dateFormatter("Y-m-d");
		
		return parent::beforeSave();
	}
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		
		// If warrentyenddate or modifieddate are being searched, convert the date format into the format needed by the database.
		$this->dateFormatter("Y-m-d");

		$criteria->compare('deviceid',$this->deviceid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('extension',$this->extension);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('devicename',$this->devicename,true);
		$criteria->compare('warrentyenddate',$this->warrentyenddate,true);
		$criteria->compare('revolvedate',$this->revolvedate,true);
		$criteria->compare('comments',$this->comments,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('serial',$this->serial,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('equipmenttype',$this->equipmenttype,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('indate',$this->indate,true);
		$criteria->compare('outdate',$this->outdate,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Convert the supplied dates to the desired format.
	 * @param string $format contains the date format that you want all of the model dates converted to.
	 */
	public function dateFormatter($format)
	{
		if((int)$this->warrentyenddate)
			$this->warrentyenddate = date($format, strtotime($this->warrentyenddate));
		if((int)$this->revolvedate)
			$this->revolvedate = date($format, strtotime($this->revolvedate));
		if((int)$this->indate)
			$this->indate = date($format, strtotime($this->indate));
		if((int)$this->outdate)
			$this->outdate = date($format, strtotime($this->outdate));
	}
}