<?php

/**
 * This is the model class for table "ci_attorney".
 *
 * The followings are the available columns in table 'ci_attorney':
 * @property integer $attyid
 * @property string $lname
 * @property string $fname
 * @property string $type
 * @property integer $barid
 *
 * The followings are the available model relations:
 * @property CaseSummary[] $ciCaseSummaries
 */
class Attorney extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Attorney the static model class
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
		return 'ci_attorney';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('lname, fname', 'required'),
			array('barid', 'numerical', 'integerOnly'=>true),
			array('lname', 'length', 'max'=>40),
			array('fname', 'length', 'max'=>25),
			array('type', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attyid, lname, fname, type, barid', 'safe', 'on'=>'search'),
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
			'ciCaseSummaries' => array(self::MANY_MANY, 'CaseSummary', 'ci_case_attorneys(attyid, summaryid)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'attyid' => 'Attorney ID',
			'lname' => "Attorney's Last Name",
			'fname' => "Attorney's First Name",
			'type' => 'Type',
			'barid' => 'Bar ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($summaryid = null)
	{
		$criteria=new CDbCriteria;
		
		if(!is_null($summaryid))
		{
			$criteria->join = "LEFT JOIN ci_case_attorneys ON ci_case_attorneys.attyid = t.attyid";
			$criteria->condition = "ci_case_attorneys.summaryid = :id";
			$criteria->params = array(":id" => $summaryid);
			$criteria->together = true;
		}
		
		$criteria->compare('attyid',$this->attyid);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('barid',$this->barid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}