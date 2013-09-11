<?php

/**
 * This is the model class for table "ci_evaluations".
 *
 * The followings are the available columns in table 'ci_evaluations':
 * @property integer $evaluationid
 * @property integer $employee
 * @property integer $evaluator
 * @property string $evaluationdate
 *
 * The followings are the available model relations:
 * @property EvaluationQuestions[] $ciEvaluationQuestions
 * @property UserInfo $employee0
 * @property UserInfo $evaluator0
 */
class Evaluations extends CActiveRecord
{
	// These variables are used to look up meaningful values of foreign keys.
	public $employee_search;
	public $evaluator_search;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evaluations the static model class
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
		return 'ci_evaluations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('employee', 'required'),
			array('employee, evaluator', 'numerical', 'integerOnly'=>true),
			array('evaluationdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('evaluationid, employee, evaluator, evaluationdate, employee_search, evaluator_search', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the evaluationdate value when a new evaluation is made.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'evaluationdate',
				'updateAttribute' => null,
			),
		);
	}
	
	/**
	 * Sets the evaluator value to the person who created the evaluation.
	 */
	protected function beforeSave()
	{
		if(null !== Yii::app()->user)
			$id=Yii::app()->user->id;
		else
			$id=1;

		if($this->isNewRecord)
			$this->evaluator=$id;
		
		return parent::beforeSave();
	}
	
	/**
	 * Log the event after a save occurs.
	 */
	protected function afterSave()
	{
		// Record the event.
		$log = new Log;
		$log->tablename = 'ci_evaluations';
		$log->event = 'Evaluation Created or Updated';
		$log->userid = Yii::app()->user->getId();
		$log->tablerow = $this->getPrimaryKey();
		$log->save(false);

		return parent::afterSave();
	}
	
	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'ciEvaluationQuestions' => array(self::MANY_MANY, 'EvaluationQuestions', 'ci_evaluation_answers(evaluationid, questionid)'),
			'employee0' => array(self::BELONGS_TO, 'UserInfo', 'employee'),
			'evaluator0' => array(self::BELONGS_TO, 'UserInfo', 'evaluator'),
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
			'evaluationid' => 'Evaluation ID',
			'employee' => 'Employee',
			'evaluator' => 'Evaluator',
			'evaluationdate' => 'Evaluation Date',
			'employee_search' => 'Employee',
			'evaluator_search' => 'Evaluator',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('employee0', 'evaluator0');
		
		if((int)$this->evaluationdate)
			$this->evaluationdate = date('Y-m-d', strtotime($this->evaluationdate));
		
		$criteria->compare('evaluationid',$this->evaluationid);
		$criteria->compare('employee',$this->employee);
		$criteria->compare('evaluator',$this->evaluator);
		$criteria->compare('evaluationdate',$this->evaluationdate,true);
		$criteria->compare('employee0.username',$this->employee_search,true);
		$criteria->compare('evaluator0.username',$this->evaluator_search,true);
				
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'employee_search'=>array(
						'asc'=>'employee0.username',
						'desc'=>'employee0.username DESC',
					),
					'evaluator_search'=>array(
						'asc'=>'evaluator0.username',
						'desc'=>'evaluator0.username DESC',
					),
					'*',
				),
			),
		));
	}
	
	/**
	 * Prepare a list of users that will be used by the dropdown list on the create evaluation page.
	 * @param Department $departments
	 * @return array
	 */
	public function prepareUserList($departments)
	{
		$allUsers = array();
		// For each department that the current user is the supervisor of.
		foreach($departments as $department)
		{
			// If the current department is not the administration department
			if($department->departmentname != 'Administration')
			{
				// Add the users in the current department, except for the current user, to a list.
				$allUsers += CHtml::ListData(UserInfo::model()->findAll(
						'departmentid=' . $department->getAttribute('departmentid') 
						. ' AND active = 1 AND userid !=' . Yii::app()->user->id), 'userid', 'username');
			}
			// People in the administration department can create evaluations for anyone, except themself.
			else
			{
				$allUsers = CHtml::ListData(UserInfo::model()->findAll(
						'active = 1 AND userid !=' . Yii::app()->user->id), 'userid', 'username');
			}
		}
		return $allUsers;
	}
}