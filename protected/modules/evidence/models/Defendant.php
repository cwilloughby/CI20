<?php

/**
 * This is the model class for table "ci_defendant".
 *
 * The followings are the available columns in table 'ci_defendant':
 * @property integer $defid
 * @property string $lname
 * @property string $fname
 * @property integer $oca
 *
 * The followings are the available model relations:
 * @property CaseSummary[] $caseSummaries
 */
class Defendant extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Defendant the static model class
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
		return 'ci_defendant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('lname', 'required'),
			array('oca', 'numerical', 'integerOnly'=>true),
			array('lname', 'length', 'max'=>40),
			array('fname', 'length', 'max'=>25),
			array('oca', 'default', 'setOnEmpty' => true, 'value' => null),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('defid, lname, fname, oca', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Log the event after a save occurs.
	 */
	protected function afterSave()
	{
		// Record the event.
		$log = new Log;
		$log->tablename = 'ci_defendant';
		$log->event = 'Defendant Created or Updated';
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
			'caseSummaries' => array(self::HAS_MANY, 'CaseSummary', 'defid'),
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
			'defid' => 'Defendant ID',
			'lname' => "Defendant's Last Name",
			'fname' => "Defendant's First Name",
			'oca' => 'OCA',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('defid',$this->defid);
		$criteria->compare('lname',$this->lname,true);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('oca',$this->oca);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Check to see if the defendant already exists in the defendant table.
	 * It it does, return the defid, otherwise create the defendant and return the new defid.
	 * @param Defendant $def
	 * @return string
	 */
	public function saveDefendant($def)
	{
		// If the oca was provided.
		if($def->oca)
		{
			// Determine if the defendant already exists.
			$defCheck = Defendant::model()->find(array(
				'select' => 'defid',
				'condition' => 'fname = :fname AND lname = :lname AND oca = :oca',
				'params' => array(':fname' => $def->fname, ':lname' => $def->lname, ':oca' => $def->oca)
			));
		}
		else
		{
			// Determine if the defendant already exists.
			$defCheck = Defendant::model()->find(array(
				'select' => 'defid',
				'condition' => 'fname = :fname AND lname = :lname',
				'params' => array(':fname' => $def->fname, ':lname' => $def->lname)
			));
		}
		
		// If the defendant does not already exists in the database.
		if(!isset($defCheck['defid']))
		{
			if($def->save())
			{
				$defCheck['defid'] = $def->defid;

				// Record the defendant create event.
				$log = new Log;
				$log->tablename = 'ci_defendant';
				$log->event = 'Defendant Created';
				$log->userid = Yii::app()->user->getId();
				$log->tablerow = $def->getPrimaryKey();
				$log->save(false);
			}
		}

		// Return the defendant's id.
		return $defCheck['defid'];
	}
}