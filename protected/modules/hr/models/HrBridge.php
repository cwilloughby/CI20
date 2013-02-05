<?php

/**
 * This is the model class for table "ci_hr_bridge".
 *
 * The followings are the available columns in table 'ci_hr_bridge':
 * @property string $policyid
 * @property integer $sectionid
 *
 * The followings are the available model relations:
 * @property HrSections $section
 */
class HrBridge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HrBridge the static model class
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
		return 'ci_hr_bridge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('policyid, sectionid', 'required'),
			array('sectionid', 'numerical', 'integerOnly'=>true),
			array('policyid', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('policyid, sectionid', 'safe', 'on'=>'search'),
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
			'section' => array(self::BELONGS_TO, 'HrSections', 'sectionid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'policyid' => 'Policyid',
			'sectionid' => 'Sectionid',
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

		$criteria->compare('policyid',$this->policyid,true);
		$criteria->compare('sectionid',$this->sectionid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}