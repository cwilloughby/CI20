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
		// Define the validation rules in an array and return it.
		return array(
			array('lname, fname', 'required'),
			array('barid', 'numerical', 'integerOnly'=>true),
			array('lname', 'length', 'max'=>40),
			array('fname', 'length', 'max'=>25),
			array('type', 'length', 'max'=>20),
			array('barid', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('attyid, lname, fname, type, barid', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Log the event after a save occurs.
	 */
	protected function afterSave()
	{
		// Record the attorney update event.
		$log = new Log;
		$log->tablename = 'ci_attorney';
		$log->event = 'Attorney Created or Updated';
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
			'ciCaseSummaries' => array(self::MANY_MANY, 'CaseSummary', 'ci_case_attorneys(attyid, summaryid)'),
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
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * actionCreate returns an array for the attorneys, but model->save() can only save one model at a time.
	 * So this function is used to split the array into individual models.
	 * @param array $formData contains all the rows from the form in an array.
	 */
	public function saveAttorneys($formData, $summaryid)
	{
		if(empty($formData))
			return false;

		$idx = 0;

		// Loop through each new attorney that the user is trying to create. 
		foreach($formData['fname'] as $ex)
		{
			$attorney = new Attorney;

			// The attributes can be found at the same postion in the formData.
			$attorney->lname = $formData['lname'][$idx];
			$attorney->fname = $formData['fname'][$idx];
			$attorney->barid = $formData['barid'][$idx];
			
			// If a bar id was provided.
			if($attorney->barid)
			{
				// Determine if the attorney already exists.
				$attyCheck = Attorney::model()->find(array(
					'select' => 'attyid',
					'condition' => 'fname = :fname AND lname = :lname AND barid = :barid',
					'params' => array(':fname' => $attorney->fname, ':lname' => $attorney->lname, ':barid' => $attorney->barid)
				));
			}
			else
			{
				// Determine if the attorney already exists.
				$attyCheck = Attorney::model()->find(array(
					'select' => 'attyid',
					'condition' => 'fname = :fname AND lname = :lname',
					'params' => array(':fname' => $attorney->fname, ':lname' => $attorney->lname)
				));
			}
			
			// If the attorney does not already exists in the database.
			if(!isset($attyCheck['attyid']))
			{
				if($attorney->save())
				{
					$attyCheck['attyid'] = $attorney->attyid;
					
					// Record the attorney create event.
					$log = new Log;
					$log->tablename = 'ci_attorney';
					$log->event = 'Attorney Created';
					$log->userid = Yii::app()->user->getId();
					$log->tablerow = $attorney->getPrimaryKey();
					$log->save(false);
				}
			}
			
			// Connect the attorney to the new case summary.
			$caseAttorney = new CaseAttorneys;
			$caseAttorney->attyid = $attyCheck['attyid'];
			$caseAttorney->summaryid = $summaryid;
			$caseAttorney->save();
			
			// Record the case attorney create event.
			$log = new Log;
			$log->tablename = 'ci_case_attorney';
			$log->event = 'Attorney Added To Case';
			$log->userid = Yii::app()->user->getId();
			$log->tablerow = $caseAttorney->summaryid . ", " . $caseAttorney->attyid;
			$log->save(false);
			
			$idx++;
		}
		return true;
	}
}