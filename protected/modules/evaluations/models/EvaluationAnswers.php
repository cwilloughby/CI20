<?php

/**
 * This is the model class for table "ci_evaluation_answers".
 *
 * The followings are the available columns in table 'ci_evaluation_answers':
 * @property integer $evaluationid
 * @property integer $questionid
 * @property string $score
 * @property string $comments
 */
class EvaluationAnswers extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EvaluationAnswers the static model class
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
		return 'ci_evaluation_answers';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('evaluationid, questionid', 'required'),
			array('evaluationid, questionid', 'numerical', 'integerOnly'=>true),
			array('comments, score', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('evaluationid, questionid, score, comments', 'safe', 'on'=>'search'),
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
			'question' => array(self::BELONGS_TO, 'EvaluationQuestions', 'questionid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evaluationid' => 'Evaluation ID',
			'questionid' => 'Question ID',
			'score' => 'Score',
			'comments' => 'Comments',
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
		$criteria->compare('questionid',$this->questionid);
		$criteria->compare('score',$this->score);
		$criteria->compare('comments',$this->comments,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}