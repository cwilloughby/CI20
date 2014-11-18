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
		// Define the validation rules in an array and return it.
		return array(
			array('caseno', 'required'),
			array('caseno, cptno', 'length', 'max'=>50),
			array('crtdiv', 'length', 'max'=>25),
			array('crtdiv', 'default', 'setOnEmpty' => true, 'value' => null),
			array('cptno', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('caseno, crtdiv, cptno', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Log the event after a save occurs.
	 */
	protected function afterSave()
	{
		// Record the court case save event.
		$log = new Log;
		$log->tablename = 'ci_crt_case';
		$log->event = 'Court Case Created or Updated';
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
			'caseSummaries' => array(self::HAS_MANY, 'CaseSummary', 'caseno'),
			'evidences' => array(self::HAS_MANY, 'Evidence', 'caseno'),
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
		$criteria=new CDbCriteria;

		$criteria->compare('caseno',$this->caseno,true);
		$criteria->compare('crtdiv',$this->crtdiv,true);
		$criteria->compare('cptno',$this->cptno,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Check to see if the case already exists in the court cases table.
	 * It it does, return the caseno, otherwise create the case and return the new caseno.
	 * @param CrtCase $case
	 * @return string
	 */
	public function saveCase($case)
	{
		$caseCheck = CrtCase::model()->find(array(
			'select' => 'caseno',
			'condition' => 'caseno = :caseno',
			'params' => array(':caseno' => $case->caseno)
		));
		
		// If the case does not already exists in the database.
		if(!isset($caseCheck['caseno']))
		{
			$caseCheck['caseno'] = $case->caseno;
			
			// Create the new case.
			if($case->save())
				$caseCheck['caseno'] = $case->caseno;
		}
		else
		{
			// Update the case's data
			$div = $case->crtdiv;
			$cpt = $case->cptno;
			$case = CrtCase::model()->findByPk($case->caseno);
			$case->crtdiv = $div;
			$case->cptno = $cpt;
			// Save the new information.
			$case->save();
		}
		
		// Return the case number.
		return $caseCheck['caseno'];
	}
}