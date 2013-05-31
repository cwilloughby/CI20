<?php

/**
 * This is the model class for table "ci_issue_tracker".
 *
 * The followings are the available columns in table 'ci_issue_tracker':
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
 */
class IssueTracker extends CActiveRecord
{
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
			array('key, type, created, resolution', 'required'),
			array('originalestimate, remainingestimate, timespent', 'numerical', 'integerOnly'=>true),
			array('key', 'length', 'max'=>10),
			array('type, reporter, assigned, resolution', 'length', 'max'=>45),
			array('summary, description, updated', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('key, type, created, reporter, summary, description, assigned, updated, originalestimate, remainingestimate, timespent, resolution', 'safe', 'on'=>'search'),
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
			'key' => 'Key',
			'type' => 'Type',
			'created' => 'Created',
			'reporter' => 'Reporter',
			'summary' => 'Summary',
			'description' => 'Description',
			'assigned' => 'Assigned',
			'updated' => 'Updated',
			'originalestimate' => 'Originalestimate',
			'remainingestimate' => 'Remainingestimate',
			'timespent' => 'Timespent',
			'resolution' => 'Resolution',
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

		$criteria->compare('key',$this->key,true);
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}