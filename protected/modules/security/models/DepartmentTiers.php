<?php

/*
 * This is the model class for table "ci_department_tiers".
 *
 * The followings are the available columns in table 'ci_department_tiers':
 * @property integer $maindepartmentid
 * @property integer $subdepartmentid
 *
 * The followings are the available model relations:
 * @property Departments $maindepartment
 * @property Departments $subdepartment
 */
class DepartmentTiers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DepartmentTiers the static model class
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
		return 'ci_department_tiers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('maindepartmentid, subdepartmentid', 'required'),
			array('maindepartmentid, subdepartmentid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('maindepartmentid, subdepartmentid', 'safe', 'on'=>'search'),
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
			'maindepartment' => array(self::BELONGS_TO, 'Departments', 'maindepartmentid'),
			'subdepartment' => array(self::BELONGS_TO, 'Departments', 'subdepartmentid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'maindepartmentid' => 'Main Department',
			'subdepartmentid' => 'Sub Department',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('maindepartmentid',$this->maindepartmentid);
		$criteria->compare('subdepartmentid',$this->subdepartmentid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
