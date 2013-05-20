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
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('employee', 'required'),
			array('employee, evaluator', 'numerical', 'integerOnly'=>true),
			array('evaluationdate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('evaluationid, employee, evaluator, evaluationdate', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the evaluationdate value
	 * when a new evaluation is made.
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
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'ciEvaluationQuestions' => array(self::MANY_MANY, 'EvaluationQuestions', 'ci_evaluation_answers(evaluationid, questionid)'),
			'employee0' => array(self::BELONGS_TO, 'UserInfo', 'employee'),
			'evaluator0' => array(self::BELONGS_TO, 'UserInfo', 'evaluator'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evaluationid' => 'Evaluationid',
			'employee' => 'Employee',
			'evaluator' => 'Evaluator',
			'evaluationdate' => 'Evaluationdate',
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

		$criteria->compare('evaluationid',$this->evaluationid);
		$criteria->compare('employee',$this->employee);
		$criteria->compare('evaluator',$this->evaluator);
		$criteria->compare('evaluationdate',$this->evaluationdate,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}