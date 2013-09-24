<?php

/**
 * This is the model class for table "ci_case_attorneys".
 *
 * The followings are the available columns in table 'ci_case_attorneys':
 * @property integer $summaryid
 * @property integer $attyid
 */
class CaseAttorneys extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CaseAttorneys the static model class
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
		return 'ci_case_attorneys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('summaryid, attyid', 'required'),
			array('summaryid, attyid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('summaryid, attyid', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Log the event after a save occurs.
	 */
	protected function afterSave()
	{
		// Record the case attorney create event.
		$log = new Log;
		$log->tablename = 'ci_case_attorney';
		$log->event = 'Attorney Added To Case';
		$log->userid = Yii::app()->user->getId();
		$log->tablerow = $this->summaryid . ", " . $this->attyid;
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
			'summaryid' => 'Summary ID',
			'attyid' => 'Attorney ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('summaryid',$this->summaryid);
		$criteria->compare('attyid',$this->attyid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}