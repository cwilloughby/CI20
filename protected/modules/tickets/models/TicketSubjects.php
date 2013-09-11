<?php

/**
 * This is the model class for table "ci_ticket_subjects".
 *
 * The followings are the available columns in table 'ci_ticket_subjects':
 * @property integer $subjectid
 * @property string $subjectname
 *
 * The followings are the available model relations:
 * @property TicketCategories[] $ciTicketCategories
 * @property TicketConditionals[] $ciTicketConditionals
 * @property Tips[] $ciTips
 * @property TroubleTickets[] $troubleTickets
 */
class TicketSubjects extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TicketSubjects the static model class
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
		return 'ci_ticket_subjects';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('subjectname', 'required'),
			array('subjectname', 'length', 'max'=>75),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('subjectid, subjectname', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'ciTicketCategories' => array(self::MANY_MANY, 'TicketCategories', 'ci_category_subject_bridge(subjectid, categoryid)', 'together'=>true),
			'ciTicketConditionals' => array(self::MANY_MANY, 'TicketConditionals', 'ci_subject_conditions(subjectid, conditionalid)'),
			'ciTips' => array(self::MANY_MANY, 'Tips', 'ci_subject_tips(subjectid, tipid)'),
			'troubleTickets' => array(self::HAS_MANY, 'TroubleTickets', 'subjectid'),
		);
	}

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
			'subjectid' => 'Subject ID',
			'subjectname' => 'Subject Name',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('subjectid',$this->subjectid);
		$criteria->compare('subjectname',$this->subjectname,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}