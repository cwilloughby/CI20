<?php

/**
 * This is the model class for table "ci_hr_sections".
 *
 * The followings are the available columns in table 'ci_hr_sections':
 * @property integer $policyid
 * @property integer $sectionid
 * @property string $section
 * @property string $datemade
 *
 * The followings are the available model relations:
 * @property HrPolicy $policy
 */
class HrSections extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HrSections the static model class
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
		return 'ci_hr_sections';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('policyid, section', 'required'),
			array('policyid, sectionid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('policyid, sectionid, section, datemade', 'safe', 'on'=>'search'),
		);
	}
	
	/**
	 * Attaches the timestamp behavior to auto set the opendate value when a new ticket is made.
	 * @return array containing behaviors.
	 */
	public function behaviors() 
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'datemade',
				'updateAttribute' => null,
			),
		);
	}
	
	/**
	 * Define the relations between this model and other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
			'policy' => array(self::BELONGS_TO, 'HrPolicy', 'policyid'),
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
			'policyid' => 'Policy ID',
			'sectionid' => 'Section ID',
			'section' => 'Section',
			'datemade' => 'Date Made',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('policyid',$this->policyid);
		$criteria->compare('sectionid',$this->sectionid);
		$criteria->compare('section',$this->section,true);
		$criteria->compare('datemade',$this->datemade,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}