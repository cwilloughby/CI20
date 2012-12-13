<?php

/**
 * This is the model class for table "ci_departments".
 *
 * The followings are the available columns in table 'ci_departments':
 * @property integer $DepartmentID
 * @property string $DepartmentName
 * @property integer $SupervisorID
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
			array('DepartmentName', 'required'),
			array('SupervisorID', 'numerical', 'integerOnly'=>true),
			array('DepartmentName', 'length', 'max'=>35),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DepartmentID, DepartmentName, SupervisorID', 'safe', 'on'=>'search'),
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
			'departmentTiers' => array(self::HAS_MANY, 'DepartmentTiers', 'MainDepartmentID'),
			'departmentTiers1' => array(self::HAS_MANY, 'DepartmentTiers', 'SubDepartmentID'),
			'supervisor' => array(self::BELONGS_TO, 'UserInfo', 'SupervisorID'),
			'userInfos' => array(self::HAS_MANY, 'UserInfo', 'DepartmentID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DepartmentID' => 'Department',
			'DepartmentName' => 'Department Name',
			'SupervisorID' => 'Supervisor',
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

		$criteria->compare('DepartmentID',$this->DepartmentID);
		$criteria->compare('DepartmentName',$this->DepartmentName,true);
		$criteria->compare('SupervisorID',$this->SupervisorID);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}