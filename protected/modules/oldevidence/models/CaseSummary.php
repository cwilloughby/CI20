<?php

/**
 * This is the model class for table "ci_case_summary".
 *
 * The followings are the available columns in table 'ci_case_summary':
 * @property integer $summaryid
 * @property integer $defid
 * @property string $caseno
 * @property string $location
 * @property string $dispodate
 * @property string $page
 * @property string $sentence
 * @property string $indate
 * @property string $outdate
 * @property string $destructiondate
 * @property string $recip
 * @property string $comment
 * @property integer $dna
 * @property integer $bio
 * @property integer $drug
 * @property integer $firearm
 * @property integer $money
 * @property integer $other
 *
 * The followings are the available model relations:
 * @property Attorney[] $ciAttorneys
 * @property CrtCase $caseno0
 * @property Defendant $def
 */
class CaseSummary extends CActiveRecord
{
	// These variables are used to look up meaningful values of foreign keys.
	public $def_search1;
	public $def_search2;
	public $div_search;
	public $complaint_search;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CaseSummary the static model class
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
		return 'ci_case_summary';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('defid, caseno', 'required'),
			array('defid, dna, bio, drug, firearm, money, other', 'numerical', 'integerOnly'=>true),
			array('caseno, recip', 'length', 'max'=>50),
			array('location, sentence', 'length', 'max'=>100),
			array('page', 'length', 'max'=>6),
			array('comment', 'length', 'max'=>255),
			array('dispodate, indate, outdate, destructiondate', 'type', 'type'=>'date', 'message'=>'{attribute} must be formatted as yyyy-mm-dd', 'dateFormat' => 'yyyy-mm-dd'),
			array('dispodate, indate, outdate, destructiondate', 'safe'),
			array('dispodate', 'default', 'setOnEmpty' => true, 'value' => null),
			array('indate', 'default', 'setOnEmpty' => true, 'value' => null),
			array('outdate', 'default', 'setOnEmpty' => true, 'value' => null),
			array('destructiondate', 'default', 'setOnEmpty' => true, 'value' => null),
			array('comment', 'default', 'setOnEmpty' => true, 'value' => null),
			array('location', 'default', 'setOnEmpty' => true, 'value' => null),
			array('sentence', 'default', 'setOnEmpty' => true, 'value' => null),
			array('recip', 'default', 'setOnEmpty' => true, 'value' => null),
			array('page', 'default', 'setOnEmpty' => true, 'value' => 'N/A'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('summaryid, defid, def_search1, def_search2, div_search, complaint_search, caseno, location, dispodate, page, sentence, indate, outdate, destructiondate, recip, comment, dna, bio, drug, firearm, money, other', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Log the event after a save occurs.
	 */
	protected function afterSave()
	{
		// Record the case summary create or update event.
		$log = new Log;
		$log->tablename = 'ci_case_summary';
		$log->event = 'Case Summary Created Or Updated';
		$log->userid = Yii::app()->user->getId();
		$log->tablerow = $this->getPrimaryKey();
		$log->save(false);

		return parent::afterSave();
	}
	
	/**
	 * Log the event after a delete occurs.
	 */
	protected function afterDelete()
	{
		// Log the delete event.
		$log = new Log;
		$log->tablename = 'ci_case_summary';
		$log->event = 'Case Summary Deleted';
		$log->userid = Yii::app()->user->getId();
		$log->tablerow = $this->getPrimaryKey();
		$log->save(false);

		return parent::afterDelete();
	}
	
	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'ciAttorneys' => array(self::MANY_MANY, 'Attorney', 'ci_case_attorneys(summaryid, attyid)'),
			'caseno0' => array(self::BELONGS_TO, 'CrtCase', 'caseno'),
			'def' => array(self::BELONGS_TO, 'Defendant', 'defid'),
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
			'defid' => 'Defendant',
			'def_search1' => 'First Name',
			'def_search2' => 'Last Name',
			'caseno' => 'Case',
			'div_search' => 'Division',
			'complaint_search' => 'Complaint Number',
			'location' => 'Location',
			'dispodate' => 'Disposition Date',
			'page' => 'Page',
			'sentence' => 'Sentence',
			'indate' => 'Indate',
			'outdate' => 'Outdate',
			'destructiondate' => 'Destruction Date',
			'recip' => 'Recip',
			'comment' => 'Comments',
			'dna' => 'DNA',
			'bio' => 'Bio',
			'drug' => 'Drug',
			'firearm' => 'Firearm',
			'money' => 'Money',
			'other' => 'Other',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->with = array('def', 'caseno0');
		
		// Convert any provided dates into a format that the database understands.
		if((int)$this->dispodate)
			$this->dispodate = date('Y-m-d', strtotime($this->dispodate));
		if((int)$this->indate)
			$this->indate = date('Y-m-d', strtotime($this->indate));
		if((int)$this->outdate)
			$this->outdate = date('Y-m-d', strtotime($this->outdate));
		if((int)$this->destructiondate)
			$this->destructiondate = date('Y-m-d', strtotime($this->destructiondate));
		
		$criteria->compare('summaryid',$this->summaryid);
		$criteria->compare('defid',$this->defid);
		$criteria->compare('def.fname',$this->def_search1,true);
		$criteria->compare('def.lname',$this->def_search2,true);
		$criteria->compare('caseno0.crtdiv',$this->div_search,true);
		$criteria->compare('caseno0.cptno',$this->complaint_search,true);
		$criteria->compare('caseno0.caseno',$this->caseno,true);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('dispodate',$this->dispodate,true);
		$criteria->compare('page',$this->page,true);
		$criteria->compare('sentence',$this->sentence,true);
		$criteria->compare('indate',$this->indate,true);
		$criteria->compare('outdate',$this->outdate,true);
		$criteria->compare('destructiondate',$this->destructiondate,true);
		$criteria->compare('recip',$this->recip,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('dna',$this->dna);
		$criteria->compare('bio',$this->bio);
		$criteria->compare('drug',$this->drug);
		$criteria->compare('firearm',$this->firearm);
		$criteria->compare('money',$this->money);
		$criteria->compare('other',$this->other);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'def_search1'=>array(
						'asc'=>'def.fname',
						'desc'=>'def.fname DESC',
					),
					'def_search2'=>array(
						'asc'=>'def.lname',
						'desc'=>'def.lname DESC',
					),
					'div_search'=>array(
						'asc'=>'caseno0.crtdiv',
						'desc'=>'caseno0.crtdiv DESC',
					),
					'complaint_search'=>array(
						'asc'=>'caseno0.cptno',
						'desc'=>'caseno0.cptno DESC',
					),
					'*',
				),
			),
		));
	}
	
	/**
	 * This function is for matching together infomation for several of the gridviews.
	 * @param various $id the value of a foreign key.
	 * @return CActiveDataProvider
	 */
	public function advancedSearch($id, $type)
	{
		$criteria = new CDbCriteria;
		$criteria->with = array('def');
		
		// If the user needs to find all the cases for a specific attorney.
		if($type == 1)
		{
			$criteria->join = "LEFT JOIN ci_case_attorneys ON ci_case_attorneys.summaryid = t.summaryid";
			$criteria->condition = "ci_case_attorneys.attyid = :id";
		}
		// If the user needs to find the case file for a specific piece of evidence.
		else if($type == 2)
		{
			$criteria->join = "LEFT JOIN ci_evidence ON ci_evidence.caseno = t.caseno";
			$criteria->condition = "ci_evidence.caseno = :id";
		}
		// If the user needs to find all the case files for a specific defendant.
		else if($type == 3)
		{
			$criteria->join = "LEFT JOIN ci_defendant ON ci_defendant.defid = t.defid";
			$criteria->condition = "ci_defendant.defid = :id";
		}
		else
		{
			$criteria->join = "LEFT JOIN ci_crt_case ON ci_crt_case.caseno = t.caseno";
			$criteria->condition = "ci_crt_case.caseno = :id";
		}
		
		$criteria->params = array(":id"=>$id);
		$criteria->compare('def.fname',$this->def_search1,true);
		$criteria->compare('def.lname',$this->def_search2,true);
		$criteria->compare('caseno',$this->caseno,true);
		$criteria->compare('sentence',$this->sentence,true);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'attributes'=>array(
					'def_search1'=>array(
						'asc'=>'def.fname',
						'desc'=>'def.fname DESC',
					),
					'def_search2'=>array(
						'asc'=>'def.lname',
						'desc'=>'def.lname DESC',
					),
					'*',
				),
			),
		));
	}

	/**
	 * This function is used to translate the 0's, 1's, and 2's of the 
	 * dna, bio, dug, firearm, other, and money columns.
	 * @param integer $yesNo
	 * @return string
	 */
	public function getYesNo($yesNo = null)
	{
		if(is_null($yesNo))
		{
			return array(
				array('id'=>'1', 'title'=>'Yes'),
				array('id'=>'0', 'title'=>'No'),
				array('id'=>'2', 'title'=>'N/A'),
			);
		}
		else 
		{
			if($yesNo == 0) 
				return 'No';
			else if($yesNo == 1)
				return 'Yes';
			else 
				return 'N/A';
		}
	}
	
	/**
	 * This function is used to combine the hearing date from multiple summaries into one string.
	 * @return string
	 */
	public function hearingDatesToString()
	{
		$return = '';
		foreach ($this->caseno0->evidences as $hDate)
		{
			$hDate->hearingdate = DATE("m/d/Y", STRTOTIME("$hDate->hearingdate"));
			if(!strstr($return, $hDate->hearingdate))
			{
				$return .= $hDate->hearingdate . ', ';
			}
		}
		return $return;
	}
	
	/**
	 * This function is used to combine the location data from multiple summaries into one string.
	 * @param string $case
	 * @return string
	 */
	public function locationsToString($case)
	{
		$casesfound = CaseSummary::model()->findAll('caseno=:caseno', array(':caseno' => $case));
		$return = '';
		foreach ($casesfound as $loc)
		{
			if($loc->location != '' && !strstr($return, $loc->location))
			{
				$return .= $loc->location . ', ';
			}
		}
		return $return;
	}
}