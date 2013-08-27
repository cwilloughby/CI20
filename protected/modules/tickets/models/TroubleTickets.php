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
 * @property TicketMessages[] $ticketMessages
 * @property UserInfo $openedby0
 * @property TicketCategories $category
 * @property UserInfo $closedbyuser
 * @property TicketSubjects $subject
 */
class TroubleTickets extends CActiveRecord
{	
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
			array('ticketid, user_search, opendate, category_search, subject_search, description, closer_search, closedate, resolution', 'safe', 'on'=>'search'),
		);
	}
	
	/**
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
	
	/**
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
			'ticketMessages' => array(self::HAS_MANY, 'TicketMessages', 'ticketid'),
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
			'user_search' => 'Opened By',
			'opendate' => 'Created On',
			'categoryid' => 'Category',
			'category_search' => 'Category',
			'subjectid' => 'Subject',
			'subject_search' => 'Subject',
			'description' => 'Description',
			'closedbyuserid' => 'Closed By',
			'closer_search' => 'Closed By',
			'closedate' => 'Closed On',
			'resolution' => 'Resolution',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$this->dateFormatter();
		$criteria=new CDbCriteria;
		$criteria->with = array('category', 'subject', 'openedby0', 'closedbyuser');
		
		$criteria->compare('ticketid',$this->ticketid);
		$criteria->compare('openedby0.username',$this->user_search,true);
		$criteria->compare('opendate',$this->opendate,true);
		$criteria->compare('category.categoryname',$this->category_search,true);
		$criteria->compare('subject.subjectname',$this->subject_search,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('closedbyuser.username',$this->closer_search,true);
		$criteria->compare('closedate',$this->closedate,true);
		$criteria->compare('resolution',$this->resolution,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>array(
					'ticketid'=>CSort::SORT_DESC,
				),
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
	
	/**
	 * Make a criteria object used for showing a list of tickets.
	 */
	public function TicketListCriteria($status = 'Open')
	{
		$criteria = new CDbCriteria;
		
		// If the user has an IT role, then they can see all open tickets.
		if(Yii::app()->user->checkAccess('IT', Yii::app()->user->id))
		{
			if($status == "Open")
				$criteria->condition = "closedbyuserid IS NULL";
			else
				$criteria->condition = "closedbyuserid IS NOT NULL";
		}
		else if(Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id))
		{
			// If the user is a supervisor, find that supervisor's department
			$department = Departments::model()->with('userInfos')->find('userInfos.userid= ' . Yii::app()->user->id);
			// Find all userids in that department.
			$allUsers = CHtml::ListData(UserInfo::model()->with('department')
					->findAll('department.departmentid=' . $department->getAttribute('departmentid')), 'userid', 'userid');
			// Put all those userid's into a string with a "," seperating each value.
			$stringed = join(',', $allUsers);
			
			if($status == "Open")
				$criteria->condition = "closedbyuserid IS NULL";
			else
				$criteria->condition = "closedbyuserid IS NOT NULL";
			
			$criteria->addCondition("openedby IN (" . $stringed . ")");
		}
		else 
		{
			if($status == "Open")
				$criteria->condition = "closedbyuserid IS NULL";
			else
				$criteria->condition = "closedbyuserid IS NOT NULL";
			
			$criteria->addCondition("openedby = :user");
			$criteria->params = array(":user" => Yii::app()->user->id);
		}
		
		return $criteria;
	}
	
	/**
	 * Convert the supplied dates, if any, to the correct format.
	 */
	public function dateFormatter()
	{
		if((int)$this->opendate)
		{
			$this->opendate = date('Y-m-d', strtotime($this->opendate));
		}
		if((int)$this->closedate)
		{
			$this->closedate = date('Y-m-d', strtotime($this->closedate));
		}
	}
	
	/**
	 * Adds a comment to this trouble ticket.
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
	
	/**
	 * Grab the subjects associated with the selected category.
	 */
	public function getSubjects()
	{
		// Grab all the subjects of the selected category.
		$subjects = Yii::app()->db->createCommand()
			->select('ci_ticket_subjects.subjectid, subjectname')
			->from('ci_ticket_subjects')
			->leftJoin('ci_category_subject_bridge','ci_category_subject_bridge.subjectid = ci_ticket_subjects.subjectid')
			->where('ci_category_subject_bridge.categoryid=:id', array(':id'=>$_GET['categoryid']))
			->order('subjectname ASC')
			->queryAll();
		
		// Put the subjects into a list that is compatible with CHtml::tag
		$data = CHtml::listData($subjects, 'subjectid', 'subjectname');
		echo CHtml::tag('option',array('value' => ''), CHtml::encode('Select a subject'),true);
		
		// Put each subject into the dropdown box.
		foreach($data as $value => $name) {
			echo CHtml::tag('option', array('value' => $value), $name,true);
		}
	}
	
	/**
	 * Grab the tips and conditional textboxes associated with the selected subject.
	 */
	public function getTipsAndConditions()
	{
		// Grab all the tips and conditionals of the selected subject.
		$tipsAndConditions = Yii::app()->db->createCommand()
			->select('ci_tips.tipid, ci_tips.tip, ci_ticket_conditionals.label')
			->from('ci_tips')
			->leftJoin('ci_subject_tips','ci_subject_tips.tipid = ci_tips.tipid')
			->leftJoin('ci_ticket_subjects','ci_ticket_subjects.subjectid = ci_subject_tips.subjectid')
			->leftJoin('ci_subject_conditions','ci_subject_conditions.subjectid = ci_ticket_subjects.subjectid')
			->leftJoin('ci_ticket_conditionals','ci_ticket_conditionals.conditionalid = ci_subject_conditions.conditionalid')
			->where('ci_subject_tips.subjectid=:id', array(':id'=>$_GET['subjectid']))
			->queryAll();

		// Put the tips into a list that is compatible with CHtml::ListBox
		$tipsData = CHtml::listData($tipsAndConditions, 'tipid', 'tip');
		
		// Output the tips.
		foreach($tipsData as $tip)
			echo CHtml::label($tip,$tip);

		echo "<br/>";
		// Put the conditionals into a list that is compatible with CHtml::label and CHtml::textField
		$conditionalData = CHtml::listData($tipsAndConditions, 'label', 'label');
		
		// Output each conditional textbox and its label.
		foreach($conditionalData as $value => $name)
		{
			if(isset($name))
			{
				echo CHtml::label($value,$name, array('required' => true));
				echo CHtml::textField($value,'', array('required' => true));
			}
		}
	}
	
	/**
	 * Since the number of conditionals are dynamic, this function is needed to retrieve them from the POST. 
	 */
	public function IsolateAndRetrieveConditionals($postval)
	{
		// Remove the first two elements and the last two elements from the POST array to isolate the conditionals.
		array_shift($postval);
		array_shift($postval);

		$this->description .= "\n\n";
		
		// Grab all the data from the conditionals and put them in the description.
		foreach($postval as $key => $value)
		{
			if($key != 'yt0')
				$this->description .= $key . ": " . $value . "\n";
		}
	}
}
