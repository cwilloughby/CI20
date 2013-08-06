<?php

/**
 * This is the model class for table "ci_issue_tracker".
 *
 * The followings are the available columns in table 'ci_issue_tracker':
 * @property integer $id
 * @property string $key
 * @property string $type
 * @property string $created
 * @property string $reporter
 * @property string $summary
 * @property string $description
 * @property string $assigned
 * @property string $updated
 * @property integer $originalestimate
 * @property integer $remainingestimate
 * @property integer $timespent
 * @property string $resolution
 * @property integer $priority
 */
class IssueTracker extends CActiveRecord
{
	public $search;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IssueTracker the static model class
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
		return 'ci_issue_tracker';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('key, type', 'required', 'on'=>'insert'),
			array('search', 'required', 'on'=>'search'),
			array('originalestimate, remainingestimate, timespent, priority', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>10),
			array('type, reporter, assigned, resolution', 'length', 'max'=>45),
			array('summary, description, updated, search', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, key, type, created, reporter, summary, description, assigned, updated, originalestimate, remainingestimate, timespent, resolution, priority, search', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Attaches the timestamp behavior to auto set the created and updated value
	 * when a new ticket is made.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created',
				'updateAttribute' => 'updated',
			),
		);
	}
	
	/**
	 * Set the priority to the last.
	 */
	protected function beforeSave()
	{
		if(is_null($this->priority))
		{
			// First we need to find the largest number in the priority column.
			$criteria = new CDbCriteria;
			$criteria->select = 'max(priority) AS priority';
			$row = IssueTracker::model()->find($criteria);
			$this->priority = $row->priority + 1;
		}
		
		return parent::beforeSave();
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
			'id' => 'ID',
			'key' => 'Key',
			'type' => 'Type',
			'created' => 'Created',
			'reporter' => 'Reporter',
			'summary' => 'Summary',
			'description' => 'Description',
			'assigned' => 'Assigned',
			'updated' => 'Updated',
			'originalestimate' => 'Original Estimate',
			'remainingestimate' => 'Remaining Estimate',
			'timespent' => 'Time Spent',
			'resolution' => 'Resolution',
			'priority' => 'Priority',
			'search' => 'Search',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
		
		if((int)$this->created)
			$this->created = date('Y-m-d', strtotime($this->created));
		
		if((int)$this->updated)
			$this->updated = date('Y-m-d', strtotime($this->updated));
		
		$criteria->compare('id',$this->id);
		$criteria->compare('t.key',$this->key,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('reporter',$this->reporter,true);
		$criteria->compare('summary',$this->summary,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('assigned',$this->assigned,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('originalestimate',$this->originalestimate);
		$criteria->compare('remainingestimate',$this->remainingestimate);
		$criteria->compare('timespent',$this->timespent);
		$criteria->compare('resolution',$this->resolution,true);
		$criteria->compare('priority',$this->priority);
		if(isset($this->search))
		{
			$criteria->compare('t.key', $this->search, true, 'OR');
			$criteria->compare('t.description', $this->search, true, 'OR');
		}
		
		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}