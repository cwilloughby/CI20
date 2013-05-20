<?php

/**
 * This is the model class for table "ci_evaluation_questions".
 *
 * The followings are the available columns in table 'ci_evaluation_questions':
 * @property integer $questionid
 * @property integer $departmentid
 * @property string $question
 *
 * The followings are the available model relations:
 * @property Evaluations[] $ciEvaluations
 * @property Departments $department
 */
class EvaluationQuestions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluationQuestions the static model class
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
		return 'ci_evaluation_questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('departmentid, question', 'required'),
			array('departmentid', 'numerical', 'integerOnly'=>true),
			array('question', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('questionid, departmentid, question', 'safe', 'on'=>'search'),
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
			'ciEvaluations' => array(self::MANY_MANY, 'Evaluations', 'ci_evaluation_answers(questionid, evaluationid)'),
			'department' => array(self::BELONGS_TO, 'Departments', 'departmentid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'questionid' => 'Questionid',
			'departmentid' => 'Departmentid',
			'question' => 'Question',
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

		$criteria->compare('questionid',$this->questionid);
		$criteria->compare('departmentid',$this->departmentid);
		$criteria->compare('question',$this->question,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}