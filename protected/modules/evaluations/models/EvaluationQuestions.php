<?php

/**
 * This is the model class for table "ci_evaluation_questions".
 *
 * The followings are the available columns in table 'ci_evaluation_questions':
 * @property integer $questionid
 * @property integer $departmentid
 * @property string $question
 * @property integer $active
 * @property integer $type
 *
 * The followings are the available model relations:
 * @property Evaluations[] $ciEvaluations
 * @property Departments $department
 */
class EvaluationQuestions extends CActiveRecord
{
	// This variable is used to look up meaningful values of foreign keys.
	public $department_search;
	
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
		// Define the validation rules in an array and return it.
		return array(
			array('question', 'required'),
			array('departmentid, active, type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('questionid, departmentid, question, active, type, department_search', 'safe', 'on'=>'search'),
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
			'ciEvaluations' => array(self::MANY_MANY, 'Evaluations', 'ci_evaluation_answers(questionid, evaluationid)'),
			'department' => array(self::BELONGS_TO, 'Departments', 'departmentid'),
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
			'questionid' => 'Question ID',
			'departmentid' => 'Department',
			'question' => 'Question',
			'active' => 'Active',
			'department_search' => 'Department',
			'type' => 'Type of Question',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('department');
		
		$criteria->compare('questionid',$this->questionid);
		$criteria->compare('departmentid',$this->departmentid);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('department.departmentname',$this->department_search,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'sort'=>array(
				'attributes'=>array(
					'department_search'=>array(
						'asc'=>'department.username',
						'desc'=>'department.username DESC',
					),
					'*',
				),
			),
		));
	}
	
	public function prepareQuestions($departments)
	{
		// Find all general questions.
		$questions = CHtml::ListData($this->findAll(
			'departmentid IS NULL'), 'questionid', 'questionid');

		// Find all questions for the department.
		$questions2 = array();
		foreach($departments as $department)
		{
			$questions2 = array_merge($questions2, CHtml::ListData($this->findAll(
				'departmentid=' . $department->getAttribute('departmentid')), 'questionid', 'questionid'));
		}
		return array_merge($questions, $questions2);
	}
}