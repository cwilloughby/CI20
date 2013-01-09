<?php

/**
 * This is the model class for table "ci_tips".
 *
 * The followings are the available columns in table 'ci_tips':
 * @property integer $tipid
 * @property string $tip
 *
 * The followings are the available model relations:
 * @property TicketSubjects[] $ciTicketSubjects
 */
class Tips extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tips the static model class
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
		return 'ci_tips';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipid', 'required'),
			array('tipid', 'numerical', 'integerOnly'=>true),
			array('tip', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('tipid, tip', 'safe', 'on'=>'search'),
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
			'ciTicketSubjects' => array(self::MANY_MANY, 'TicketSubjects', 'ci_subject_tips(tipid, subjectid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'tipid' => 'Tipid',
			'tip' => 'Tip',
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

		$criteria->compare('tipid',$this->tipid);
		$criteria->compare('tip',$this->tip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}