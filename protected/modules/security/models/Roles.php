<?php

/**
 * This is the model class for table "ci_roles".
 *
 * The followings are the available columns in table 'ci_roles':
 * @property integer $roleid
 * @property string $rolename
 *
 * The followings are the available model relations:
 * @property UserInfo[] $userInfos
 */
class Roles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Roles the static model class
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
		return 'ci_roles';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rolename', 'required'),
			array('rolename', 'length', 'max'=>35),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('roleid, rolename', 'safe', 'on'=>'search'),
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
			'userInfos' => array(self::HAS_MANY, 'UserInfo', 'roleid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'roleid' => 'Role',
			'rolename' => 'Role Name',
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

		$criteria->compare('roleid',$this->roleid);
		$criteria->compare('rolename',$this->rolename,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}