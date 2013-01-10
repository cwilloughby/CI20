<?php

/**
 * This is the model class for table "ci_trouble_tickets".
 *
 * The followings are the available columns in table 'ci_trouble_tickets':
 * @property integer $ticketid
 * @property integer $openedby
 * @property string $opendate
 * @property integer $categoryid
 * @property integer $subjectid
 * @property string $description
 * @property integer $closedbyuserid
 * @property string $closedate
 * @property string $resolution
 *
 * The followings are the available model relations:
 * @property TicketComments[] $ticketComments
 * @property UserInfo $openedby0
 * @property TicketCategories $category
 * @property UserInfo $closedbyuser
 * @property TicketSubjects $subject
 */
class TroubleTickets extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TroubleTickets the static model class
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
		return 'ci_trouble_tickets';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('openedby, opendate, categoryid, subjectid', 'required'),
			array('openedby, categoryid, subjectid, closedbyuserid', 'numerical', 'integerOnly'=>true),
			array('description, closedate, resolution', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ticketid, openedby, opendate, categoryid, subjectid, description, closedbyuserid, closedate, resolution', 'safe', 'on'=>'search'),
		);
	}
	
	/*
	 * Attaches the timestamp behavior to auto set the opendate value
	 * when a new ticket is made.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'opendate',
				'setUpdateOnCreate' => true,
			),
		);
	}
	
	/*
	 * Sets the openedby or closedbyuserid values to the person who opened or closed the ticket.
	 */
	protected function beforeSave()
	{
		if(null !== Yii::app()->user)
			$id=Yii::app()->user->id;
		else
			$id=1;

		if($this->isNewRecord)
			$this->openedby=$id;

		$this->closedbyuserid=$id;

		return parent::beforeSave();
	}
	
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ticketComments' => array(self::HAS_MANY, 'TicketComments', 'ticketid'),
			'openedby0' => array(self::BELONGS_TO, 'UserInfo', 'openedby'),
			'category' => array(self::BELONGS_TO, 'TicketCategories', 'categoryid'),
			'closedbyuser' => array(self::BELONGS_TO, 'UserInfo', 'closedbyuserid'),
			'subject' => array(self::BELONGS_TO, 'TicketSubjects', 'subjectid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ticketid' => 'Ticketid',
			'openedby' => 'Openedby',
			'opendate' => 'Opendate',
			'categoryid' => 'Categoryid',
			'subjectid' => 'Subjectid',
			'description' => 'Description',
			'closedbyuserid' => 'Closedbyuserid',
			'closedate' => 'Closedate',
			'resolution' => 'Resolution',
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

		$criteria->compare('ticketid',$this->ticketid);
		$criteria->compare('openedby',$this->openedby);
		$criteria->compare('opendate',$this->opendate,true);
		$criteria->compare('categoryid',$this->categoryid);
		$criteria->compare('subjectid',$this->subjectid);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('closedbyuserid',$this->closedbyuserid);
		$criteria->compare('closedate',$this->closedate,true);
		$criteria->compare('resolution',$this->resolution,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}