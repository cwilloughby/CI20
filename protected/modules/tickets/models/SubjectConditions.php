<?php

/**
 * This is the model class for table "ci_subject_conditions".
 *
 * The followings are the available columns in table 'ci_subject_conditions':
 * @property integer $subjectid
 * @property integer $conditionalid
 */
class SubjectConditions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SubjectConditions the static model class
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
		return 'ci_subject_conditions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subjectid, conditionalid', 'required'),
			array('subjectid, conditionalid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('subjectid, conditionalid', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'subjectid' => 'Subject ID',
			'conditionalid' => 'Conditional ID',
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
		$criteria->compare('conditionalid',$this->conditionalid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}