<?php

/*
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
 * @property string $hiredate
 * @property integer $active
 *
 * The followings are the available model relations:
 * @property Comments[] $comments
 * @property ComputerInventory[] $computerInventories
 * @property Departments[] $departments
 * @property DocumentProcessor[] $documentProcessors
 * @property Documents[] $documents
 * @property Evaluations[] $evaluations
 * @property Evaluations[] $evaluations1
 * @property TroubleTickets[] $troubleTickets
 * @property TroubleTickets[] $troubleTickets1
 * @property Departments $department
 */
class UserInfo extends CActiveRecord
{
	public $oldpassword;
	public $password_repeat;
	
	/*
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserInfo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/*
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ci_user_info';
	}

	/*
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('firstname, lastname, username, password, email, phoneext, hiredate, active', 'required', 'on'=>'insert'),
			array('username', 'required', 'on'=>'request'),
			array('oldpassword, password, password_repeat', 'required', 'on'=>'change'),
			array('username, password, password_repeat', 'required', 'on'=>'recovery'),
			array('username', 'exist', 'on'=>'recovery'),
			array('username', 'exist', 'on'=>'request'),
			array('oldpassword', 'checkOld', 'on'=>'change'),
			array('phoneext, departmentid, active', 'numerical', 'integerOnly'=>true),
			array('firstname', 'length', 'max'=>30),
			array('lastname', 'length', 'max'=>40),
			array('middlename', 'length', 'max'=>45),
			array('username', 'length', 'max'=>41),
			array('username', 'dataDoesNotExist', 'on'=>'insert', 'col'=>'username'),
			array('password', 'length', 'max'=>128),
			array('password', 'compare', 'on'=>'change'),
			array('password', 'compare', 'on'=>'recovery'),
			array('email', 'length', 'max'=>100),
			array('email', 'email'),
			array('email', 'dataDoesNotExist', 'on'=>'insert', 'col'=>'email'),
			array('password_repeat, oldpassword', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, firstname, lastname, middlename, username, password, email, phoneext, departmentid, hiredate, active', 'safe', 'on'=>'search'),
		);
	}
	
	public function dataDoesNotExist($attribute, $params)
	{
		if(($params['col'] == 'email' && $this->find("$attribute = '$this->email'"))
			|| ($params['col'] == 'username' && $this->find("$attribute = '$this->username'")))
		{
			$this->addError($attribute, 'That ' . $attribute . ' already exists.');
		}
	}

	public function checkOld($attribute, $params)
	{
		$user = Yii::app()->user->getName();
		$userinfo = $this->find("username = '$user'");
		
		if($userinfo->password != sha1($this->oldpassword))
		{
			$this->addError($attribute, 'Old password is incorrect.');
		}
	}
	
	/*
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'comments' => array(self::HAS_MANY, 'Comments', 'createdby'),
            'computerInventories' => array(self::HAS_MANY, 'ComputerInventory', 'userid'),
            'departments' => array(self::HAS_MANY, 'Departments', 'supervisorid'),
            'documentProcessors' => array(self::HAS_MANY, 'DocumentProcessor', 'completedby'),
            'documents' => array(self::HAS_MANY, 'Documents', 'uploader'),
            'evaluations' => array(self::HAS_MANY, 'Evaluations', 'employee'),
            'evaluations1' => array(self::HAS_MANY, 'Evaluations', 'evaluator'),
            'troubleTickets' => array(self::HAS_MANY, 'TroubleTickets', 'openedby'),
            'troubleTickets1' => array(self::HAS_MANY, 'TroubleTickets', 'closedbyuserid'),
            'department' => array(self::BELONGS_TO, 'Departments', 'departmentid'),
		);
	}

	/*
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
			'oldpassword' => 'Old Password',
			'password_repeat' => 'Confirm Password',
			'email' => 'Email',
			'phoneext' => 'Phone Ext',
			'departmentid' => 'Department',
			'hiredate' => 'Hire Date',
		);
	}

	/*
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;

		$criteria->compare('userid',$this->userid);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('middlename',$this->middlename,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phoneext',$this->phoneext);
		$criteria->compare('departmentid',$this->departmentid);
		$criteria->compare('hiredate',$this->hiredate,true);
		$criteria->compare('active',$this->active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
