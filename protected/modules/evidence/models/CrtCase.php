<?php

/**
 * This is the model class for table "ci_crt_case".
 *
 * The followings are the available columns in table 'ci_crt_case':
 * @property string $caseno
 * @property string $crtdiv
 * @property string $cptno
 *
 * The followings are the available model relations:
 * @property CaseSummary[] $caseSummaries
 * @property Evidence[] $evidences
 */
class CrtCase extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CrtCase the static model class
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
		return 'ci_crt_case';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caseno', 'required'),
			array('caseno, cptno', 'length', 'max'=>50),
			array('crtdiv', 'length', 'max'=>25),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('caseno, crtdiv, cptno', 'safe', 'on'=>'search'),
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
			'caseSummaries' => array(self::HAS_MANY, 'CaseSummary', 'caseno'),
			'evidences' => array(self::HAS_MANY, 'Evidence', 'caseno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'caseno' => 'Case Number',
			'crtdiv' => 'Court Division',
			'cptno' => 'Complaint Number',
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

		$criteria->compare('caseno',$this->caseno,true);
		$criteria->compare('crtdiv',$this->crtdiv,true);
		$criteria->compare('cptno',$this->cptno,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/*
	 * Check to see if the case already exists in the court cases table.
	 * It it does, return the caseno, otherwise create the case and return the new caseno.
	 */
	public function saveCase($case)
	{
		if($case->caseno)
		{
			$caseCheck = CrtCase::model()->find(array(
				'select' => 'caseno',
				'condition' => 'caseno = :caseno',
				'params' => array(':caseno' => $case->caseno)
			));
		}
		
		// If the defendant does not already exists in the database.
		if(!isset($caseCheck['caseno']))
		{
			if($case->save())
			{
				$caseCheck['caseno'] = $case->caseno;

				// Record the court case create event. Commented out for testing.
				/*
				$log = new Log;
				$log->tablename = 'ci_crt_case';
				$log->event = 'Court Case Created';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $case->getPrimaryKey();
				$log->save(false);
				*/
			}
		}

		echo "Save Case Number: " . $caseCheck['caseno'] . "<br/>";
		// Return the case number.
		return $caseCheck['caseno'];
	}
}