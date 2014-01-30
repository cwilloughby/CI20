<?php

/**
 * This is the model class for table "ci_cjis_dispositions".
 *
 * The followings are the available columns in table 'ci_cjis_dispositions':
 * @property integer $dispoid
 * @property string $court
 * @property string $case
 * @property string $lastname
 * @property string $firstname
 * @property string $dateofbirth
 * @property string $gender
 * @property string $race
 * @property integer $count
 * @property string $offensedescription
 * @property string $offensetype
 * @property string $disposition
 * @property string $dateconcluded
 * @property string $location
 * @property integer $incarcerationyears
 * @property integer $incarcerationmonths
 * @property integer $incarcerationdays
 * @property integer $incarcerationhours
 * @property string $percentage
 * @property string $suspendallbut
 * @property string $suspendpercentage
 * @property string $dayfordayflag
 * @property string $hourforhourflag
 * @property string $suspendedflag
 * @property string $noworkdetailflag
 * @property string $workreleaseflag
 * @property string $workreleasepercentage
 * @property string $earlyreleaseflag
 * @property string $timeservedcredit
 * @property string $specifiedjailcreditmonths
 * @property string $specifiedjailcreditdays
 * @property string $specifiedjailcredithours
 * @property string $incarcerationspecialconditions
 * @property string $probationtype
 * @property integer $probationyears
 * @property integer $probationmonths
 * @property integer $probationdays
 * @property string $probationspecialconditions
 * @property string $restitutionamount
 * @property string $courtfines
 * @property string $finesspecialcondition
 */
class CjisDispositions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CjisDispositions the static model class
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
		return 'ci_cjis_dispositions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('case, lastname, firstname, dateofbirth, gender, race, offensedescription, offensetype, specifiedjailcreditdays, specifiedjailcredithours', 'required'),
			array('count, incarcerationyears, incarcerationmonths, incarcerationdays, incarcerationhours, probationyears, probationmonths, probationdays', 'numerical', 'integerOnly'=>true),
			array('court', 'length', 'max'=>8),
			array('case, offensetype, percentage, suspendallbut, suspendpercentage, workreleasepercentage, timeservedcredit, probationtype, restitutionamount, courtfines', 'length', 'max'=>25),
			array('lastname, firstname, disposition, location, specifiedjailcreditmonths, specifiedjailcreditdays, specifiedjailcredithours', 'length', 'max'=>45),
			array('gender, race, dayfordayflag, hourforhourflag, suspendedflag, noworkdetailflag, workreleaseflag, earlyreleaseflag', 'length', 'max'=>1),
			array('dateconcluded, incarcerationspecialconditions, probationspecialconditions, finesspecialcondition', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('court, case, lastname, firstname, dateofbirth, gender, race, count, offensedescription, offensetype, disposition, dateconcluded, location, incarcerationyears, incarcerationmonths, incarcerationdays, incarcerationhours, percentage, suspendallbut, suspendpercentage, dayfordayflag, hourforhourflag, suspendedflag, noworkdetailflag, workreleaseflag, workreleasepercentage, earlyreleaseflag, timeservedcredit, specifiedjailcreditmonths, specifiedjailcreditdays, specifiedjailcredithours, incarcerationspecialconditions, probationtype, probationyears, probationmonths, probationdays, probationspecialconditions, restitutionamount, courtfines, finesspecialcondition', 'safe', 'on'=>'search'),
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
			'dispoid' => 'Dispoid',
			'court' => 'Court',
			'case' => 'Case',
			'lastname' => 'Lastname',
			'firstname' => 'Firstname',
			'dateofbirth' => 'Date of Birth',
			'gender' => 'Gender',
			'race' => 'Race',
			'count' => 'Count',
			'offensedescription' => 'Offense Description',
			'offensetype' => 'Offense Type',
			'disposition' => 'Disposition',
			'dateconcluded' => 'Date Concluded',
			'location' => 'Location',
			'incarcerationyears' => 'Incarceration Years',
			'incarcerationmonths' => 'Incarceration Months',
			'incarcerationdays' => 'Incarceration Days',
			'incarcerationhours' => 'Incarceration Hours',
			'percentage' => 'Percentage',
			'suspendallbut' => 'Suspend all but',
			'suspendpercentage' => 'Suspend Percentage',
			'dayfordayflag' => 'Day for day flag',
			'hourforhourflag' => 'Hour for hour flag',
			'suspendedflag' => 'Suspended flag',
			'noworkdetailflag' => 'No work detail flag',
			'workreleaseflag' => 'Work release flag',
			'workreleasepercentage' => 'Work release percentage',
			'earlyreleaseflag' => 'Early release flag',
			'timeservedcredit' => 'Time served credit',
			'specifiedjailcreditmonths' => 'Specified jail credit months',
			'specifiedjailcreditdays' => 'Specified jail credit days',
			'specifiedjailcredithours' => 'Specified jail credit hours',
			'incarcerationspecialconditions' => 'Incarceration special conditions',
			'probationtype' => 'Probation type',
			'probationyears' => 'Probation years',
			'probationmonths' => 'Probation months',
			'probationdays' => 'Probation days',
			'probationspecialconditions' => 'Probation special conditions',
			'restitutionamount' => 'Restitution amount',
			'courtfines' => 'Court fines',
			'finesspecialcondition' => 'Fines special condition',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$this->dateFormatter();
		$criteria=new CDbCriteria;

		$criteria->compare('court',$this->court,true);
		$criteria->compare('case',$this->case,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('firstname',$this->firstname,true);
		$criteria->compare('dateofbirth',$this->dateofbirth,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('race',$this->race,true);
		$criteria->compare('count',$this->count);
		$criteria->compare('offensedescription',$this->offensedescription,true);
		$criteria->compare('offensetype',$this->offensetype,true);
		$criteria->compare('disposition',$this->disposition,true);
		$criteria->compare('dateconcluded',$this->dateconcluded,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('incarcerationyears',$this->incarcerationyears);
		$criteria->compare('incarcerationmonths',$this->incarcerationmonths);
		$criteria->compare('incarcerationdays',$this->incarcerationdays);
		$criteria->compare('incarcerationhours',$this->incarcerationhours);
		$criteria->compare('percentage',$this->percentage,true);
		$criteria->compare('suspendallbut',$this->suspendallbut,true);
		$criteria->compare('suspendpercentage',$this->suspendpercentage,true);
		$criteria->compare('dayfordayflag',$this->dayfordayflag,true);
		$criteria->compare('hourforhourflag',$this->hourforhourflag,true);
		$criteria->compare('suspendedflag',$this->suspendedflag,true);
		$criteria->compare('noworkdetailflag',$this->noworkdetailflag,true);
		$criteria->compare('workreleaseflag',$this->workreleaseflag,true);
		$criteria->compare('workreleasepercentage',$this->workreleasepercentage,true);
		$criteria->compare('earlyreleaseflag',$this->earlyreleaseflag,true);
		$criteria->compare('timeservedcredit',$this->timeservedcredit,true);
		$criteria->compare('specifiedjailcreditmonths',$this->specifiedjailcreditmonths,true);
		$criteria->compare('specifiedjailcreditdays',$this->specifiedjailcreditdays,true);
		$criteria->compare('specifiedjailcredithours',$this->specifiedjailcredithours,true);
		$criteria->compare('incarcerationspecialconditions',$this->incarcerationspecialconditions,true);
		$criteria->compare('probationtype',$this->probationtype,true);
		$criteria->compare('probationyears',$this->probationyears);
		$criteria->compare('probationmonths',$this->probationmonths);
		$criteria->compare('probationdays',$this->probationdays);
		$criteria->compare('probationspecialconditions',$this->probationspecialconditions,true);
		$criteria->compare('restitutionamount',$this->restitutionamount,true);
		$criteria->compare('courtfines',$this->courtfines,true);
		$criteria->compare('finesspecialcondition',$this->finesspecialcondition,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Convert the supplied dates, if any, to the format recognized by the database.
	 */
	public function dateFormatter()
	{
		if((int)$this->dateofbirth)
			$this->dateofbirth = date('Y-m-d', strtotime($this->dateofbirth));
		if((int)$this->dateconcluded)
			$this->dateconcluded = date('Y-m-d', strtotime($this->dateconcluded));
	}
}