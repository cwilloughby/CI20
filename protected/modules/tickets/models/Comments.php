<?php

/**
 * This is the model class for table "ci_comments".
 *
 * The followings are the available columns in table 'ci_comments':
 * @property integer $commentid
 * @property string $content
 * @property integer $createdby
 * @property string $datecreated
 *
 * The followings are the available model relations:
 * @property UserInfo $createdby0
 * @property TroubleTickets[] $ciTroubleTickets
 */
class Comments extends CActiveRecord
{
	public $user_search;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return 'ci_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content', 'required'),
			array('createdby', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('commentid, content, createdby, datecreated, user_search', 'safe', 'on'=>'search'),
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
			'createdby0' => array(self::BELONGS_TO, 'UserInfo', 'createdby'),
			'ciTroubleTickets' => array(self::MANY_MANY, 'TroubleTickets', 'ci_ticket_comments(commentid, ticketid)'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the datecreated value
	 * when a new comment is made.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'datecreated',
				'updateAttribute' => null,
			),
		);
	}
	
	/**
	 * Sets the createdby value to the person who made the comment.
	 */
	protected function beforeSave()
	{
		if(null !== Yii::app()->user)
			$id=Yii::app()->user->id;
		else
			$id=1;

		if($this->isNewRecord)
			$this->createdby=$id;

		return parent::beforeSave();
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'commentid' => 'Comment ID',
			'content' => 'Content',
			'createdby' => 'Created By',
			'datecreated' => 'Date Created',
			'user_search' => 'Created By',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('createdby0');
			
		$criteria->compare('commentid',$this->commentid);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('createdby0.username',$this->user_search,true);
		$criteria->compare('datecreated',$this->datecreated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'user_search'=>array(
						'asc'=>'createdby0.username',
						'desc'=>'createdby0.username DESC',
					),
					'*',
				),
			),
		));
	}
}