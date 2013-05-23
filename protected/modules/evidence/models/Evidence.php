<?php

/**
 * This is the model class for table "ci_evidence".
 *
 * The followings are the available columns in table 'ci_evidence':
 * @property integer $evidenceid
 * @property string $caseno
 * @property string $hearingtype
 * @property string $hearingdate
 * @property string $exhibitno
 * @property string $evidencename
 * @property string $comment
 * @property string $dateadded
 * @property integer $exhibitlist
 *
 * The followings are the available model relations:
 * @property CrtCase $caseno0
 */
class Evidence extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Evidence the static model class
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
		return 'ci_evidence';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('caseno, hearingdate, hearingtype, exhibitno, evidencename', 'required'),
			array('caseno', 'length', 'max'=>50),
			array('hearingtype', 'length', 'max'=>45),
			array('exhibitno', 'length', 'max'=>20),
			array('evidencename', 'length', 'max'=>1000),
			array('comment', 'length', 'max'=>100),
			array('hearingdate, dateadded', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('evidenceid, caseno, exhibitno, evidencename, comment, dateadded, exhibitlist, hearingdate, hearingtype,', 'safe', 'on'=>'search'),
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
			'caseno0' => array(self::BELONGS_TO, 'CrtCase', 'caseno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'evidenceid' => 'Evidence ID',
			'caseno' => 'Case Number',
			'exhibitno' => 'Exhibit #',
			'evidencename' => 'Evidence Name',
			'comment' => 'Comment',
			'dateadded' => 'Date Added',
			'hearingdate' => 'Hearing Date',
			'hearingtype' => 'Hearing Type',
			'exhibitlist' => 'Exhibit List',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($caseno = null)
	{
		$criteria=new CDbCriteria;

		if(!is_null($caseno))
		{
			$criteria->condition = "caseno=:caseno";
			$criteria->params = array(":caseno" => $caseno);
		}
		
		$criteria->compare('evidenceid',$this->evidenceid);
		$criteria->compare('caseno',$this->caseno,true);
		$criteria->compare('exhibitno',$this->exhibitno,true);
		$criteria->compare('evidencename',$this->evidencename,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('dateadded',$this->dateadded,true);
		$criteria->compare('hearingdate',$this->hearingdate,true);
		$criteria->compare('hearingtype',$this->hearingtype,true);
		$criteria->compare('exhibitlist',$this->exhibitlist);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * actionCreate returns an array, but model->save() can only save one model at a time.
	 * So this function is used to split the array into individual models.
	 * @param array $formData contains all the rows from the form in an array.
	 */
	public function saveEvidence($formData)
	{
		if(empty($formData))
			return false;

		$idx = 0;

		// Loop through the array, splitting it into individual models and saving those models. 
		foreach($formData['exhibitno'] as $ex)
		{
			$model = new Evidence;

			// The attributes can be found at the same postion in the formData.
			$model->caseno = $formData['caseno'][$idx];
			$model->hearingtype = $formData['hearingtype'][$idx];
			$model->hearingdate = date('Y-m-d', strtotime($formData['hearingdate'][$idx]));
			$model->exhibitno = $ex;
			$model->evidencename = $formData['evidencename'][$idx];
			$model->comment = $formData['comment'][$idx];
			$model->exhibitlist = $formData['exhibitlist'][$idx];
			
			if(!$model->save())
				return false;
			
			// Record the evidence create event.
			$log = new Log;
			$log->tablename = 'ci_evidence';
			$log->event = 'Evidence Created';
			$log->userid = Yii::app()->user->getId();
			$log->tablerow = $model->getPrimaryKey();
			$log->save(false);
			
			$idx++;
		}
		return true;
	}
}