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
	public $tips;
	
	public $subject_search;
	public $category_search;
	public $user_search;
	public $closer_search;
	
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
			array('categoryid, subjectid', 'required'),
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
				'updateAttribute' => 'closedate',
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
			'ticketid' => 'Ticket #',
			'openedby' => 'Opened By',
			'opendate' => 'Created On',
			'categoryid' => 'Category',
			'subjectid' => 'Subject',
			'description' => 'Description',
			'closedbyuserid' => 'Closed By',
			'closedate' => 'Closed On',
			'resolution' => 'Resolution',
			'tips' => 'Tips',
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
		$criteria->compare('openedby',$this->user_search,true);
		$criteria->compare('opendate',$this->opendate,true);
		$criteria->compare('categoryid',$this->category_search,true);
		$criteria->compare('subject.subjectname',$this->subject_search,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('closedbyuserid',$this->closer_search,true);
		$criteria->compare('closedate',$this->closedate,true);
		$criteria->compare('resolution',$this->resolution,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'user_search'=>array(
						'asc'=>'openedby0.username',
						'desc'=>'openedby0.username DESC',
					),
					'subject_search'=>array(
						'asc'=>'subject.subjectname',
						'desc'=>'subject.subjectname DESC',
					),
					'category_search'=>array(
						'asc'=>'category.categoryname',
						'desc'=>'category.categoryname DESC',
					),
					'closer_search'=>array(
						'asc'=>'closedbyuser.username',
						'desc'=>'closedbyuser.username DESC',
					),
					'*',
				),
			),
		));
	}
	
	/*
	 * Adds a comment to this trouble ticket.
	 * This is a place holder for now.
	 */
	public function addComment($comment)
	{
		// Save the new comment.
		if($comment->save())
		{
			// Connect the new comment to the ticket on the bridge table.
			$bridge = new TicketComments;
			$bridge->commentid = $comment->commentid;
			$bridge->ticketid = $this->ticketid;
			$bridge->save();
			return true;
		}
		else
			return false;
	}
}
