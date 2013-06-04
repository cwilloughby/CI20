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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question', 'required'),
			array('departmentid, active, type', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('questionid, departmentid, question, active, type, department_search', 'safe', 'on'=>'search'),
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
}