<?php

/**
 * This is the model class for table "ci_departments".
 *
 * The followings are the available columns in table 'ci_departments':
 * @property integer $departmentid
 * @property string $departmentname
 * @property integer $supervisorid
 *
 * The followings are the available model relations:
 * @property DepartmentTiers[] $departmentTiers
 * @property DepartmentTiers[] $departmentTiers1
 * @property UserInfo $supervisor
 * @property UserInfo[] $userInfos
 */
class Departments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Departments the static model class
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
		return 'ci_departments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departmentname', 'required'),
			array('supervisorid', 'numerical', 'integerOnly'=>true),
			array('departmentname', 'length', 'max'=>35),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('departmentid, departmentname, supervisorid', 'safe', 'on'=>'search'),
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
			'departmentTiers' => array(self::HAS_MANY, 'DepartmentTiers', 'maindepartmentid'),
			'departmentTiers1' => array(self::HAS_MANY, 'DepartmentTiers', 'subdepartmentid'),
			'supervisor' => array(self::BELONGS_TO, 'UserInfo', 'supervisorid'),
			'userInfos' => array(self::HAS_MANY, 'UserInfo', 'departmentid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'departmentid' => 'Department',
			'departmentname' => 'Department Name',
			'supervisorid' => 'Supervisor',
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

		$criteria->compare('departmentid',$this->departmentid);
		$criteria->compare('departmentname',$this->departmentname,true);
		$criteria->compare('supervisorid',$this->supervisorid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
