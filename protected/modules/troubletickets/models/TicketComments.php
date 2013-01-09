<?php

/**
 * This is the model class for table "ci_ticket_comments".
 *
 * The followings are the available columns in table 'ci_ticket_comments':
 * @property integer $commentid
 * @property integer $ticketid
 *
 * The followings are the available model relations:
 * @property Comments $comments
 * @property TroubleTickets $ticket
 */
class TicketComments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TicketComments the static model class
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
		return 'ci_ticket_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('commentid, ticketid', 'required'),
			array('commentid, ticketid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('commentid, ticketid', 'safe', 'on'=>'search'),
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
			'comments' => array(self::HAS_ONE, 'Comments', 'commentid'),
			'ticket' => array(self::BELONGS_TO, 'TroubleTickets', 'ticketid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'commentid' => 'Commentid',
			'ticketid' => 'Ticketid',
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

		$criteria->compare('commentid',$this->commentid);
		$criteria->compare('ticketid',$this->ticketid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}