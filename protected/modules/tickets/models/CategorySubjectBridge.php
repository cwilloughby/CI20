<?php

/**
 * This is the model class for table "ci_category_subject_bridge".
 *
 * The followings are the available columns in table 'ci_category_subject_bridge':
 * @property integer $categoryid
 * @property integer $subjectid
 */
class CategorySubjectBridge extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CategorySubjectBridge the static model class
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
		return 'ci_category_subject_bridge';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('categoryid, subjectid', 'required'),
			array('categoryid, subjectid', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('categoryid, subjectid', 'safe', 'on'=>'search'),
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
			'categoryid' => 'Category ID',
			'subjectid' => 'Subject ID',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('categoryid',$this->categoryid);
		$criteria->compare('subjectid',$this->subjectid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}