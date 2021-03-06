<?php

/**
 * This is the model class for table "ci_ticket_conditionals".
 *
 * The followings are the available columns in table 'ci_ticket_conditionals':
 * @property integer $conditionalid
 * @property string $label
 *
 * The followings are the available model relations:
 * @property TicketSubjects[] $ciTicketSubjects
 */
class TicketConditionals extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TicketConditionals the static model class
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
		return 'ci_ticket_conditionals';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('label', 'required'),
			array('label', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('conditionalid, label', 'safe', 'on'=>'search'),
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
			'ciTicketSubjects' => array(self::MANY_MANY, 'TicketSubjects', 'ci_subject_conditions(conditionalid, subjectid)'),
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
			'conditionalid' => 'Conditional ID',
			'label' => 'Label',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('conditionalid',$this->conditionalid);
		$criteria->compare('label',$this->label,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}