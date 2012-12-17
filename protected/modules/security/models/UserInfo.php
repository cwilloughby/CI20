<?php

/**
 * This is the model class for table "ci_user_info".
 *
 * The followings are the available columns in table 'ci_user_info':
 * @property integer $userid
 * @property string $firstname
 * @property string $lastname
 * @property string $middlename
 * @property string $username
 * @property string $password
 * @property string $email
 * @property integer $phoneext
 * @property integer $departmentid
 * @property integer $roleid
 * @property string $hiredate
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property ComputerInventory[] $computerInventories
 * @property DocumentProcessor[] $documentProcessors
 * @property Documents[] $documents
 * @property Evaluations[] $evaluations
 * @property Evaluations[] $evaluations1
 * @property TroubleTickets[] $troubleTickets
 * @property TroubleTickets[] $troubleTickets1
 */
class UserInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserInfo the static model class
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
		return 'ci_user_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, username, password, email, phoneext, hiredate, active', 'required'),
			array('phoneext, departmentid, roleid, active', 'numerical', 'integerOnly'=>true),
			array('firstname', 'length', 'max'=>30),
			array('lastname', 'length', 'max'=>40),
			array('middlename', 'length', 'max'=>45),
			array('username', 'length', 'max'=>41),
			array('password', 'length', 'max'=>128),
			array('email', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, firstname, lastname, middlename, username, password, email, phoneext, departmentid, roleid, hiredate, active', 'safe', 'on'=>'search'),
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
			'computerInventories' => array(self::HAS_MANY, 'ComputerInventory', 'userid'),
			'documentProcessors' => array(self::HAS_MANY, 'DocumentProcessor', 'completedby'),
			'documents' => array(self::HAS_MANY, 'Documents', 'uploader'),
			'evaluations' => array(self::HAS_MANY, 'Evaluations', 'employee'),
			'evaluations1' => array(self::HAS_MANY, 'Evaluations', 'evaluator'),
			'troubleTickets' => array(self::HAS_MANY, 'TroubleTickets', 'openedby'),
			'troubleTickets1' => array(self::HAS_MANY, 'TroubleTickets', 'closedbyuserid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'firstName' => 'First Name',
			'lastName' => 'Last Name',
			'middleName' => 'Middle Name',
			'username' => 'Username',
			'password' => 'Password',
			'email' => 'Email',
			'phoneext' => 'Phone Ext',
			'departmentid' => 'Department',
			'roleid' => 'Role',
			'hiredate' => 'Hire Date',
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

		$criteria->compare('UserID',$this->UserID);
		$criteria->compare('FirstName',$this->FirstName,true);
		$criteria->compare('LastName',$this->LastName,true);
		$criteria->compare('MiddleName',$this->MiddleName,true);
		$criteria->compare('Username',$this->Username,true);
		$criteria->compare('Password',$this->Password,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('PhoneExt',$this->PhoneExt);
		$criteria->compare('DepartmentID',$this->DepartmentID);
		$criteria->compare('RoleID',$this->RoleID);
		$criteria->compare('HireDate',$this->HireDate,true);
		$criteria->compare('Active',$this->Active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
