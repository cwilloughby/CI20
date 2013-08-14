<?php

/**
 * This is the model class for table "ci_document_queues".
 *
 * The followings are the available columns in table 'ci_document_queues':
 * @property integer $itemid
 * @property string $queue
 * @property integer $documentid
 * @property string $completedby
 * @property string $completiondate
 *
 * The followings are the available model relations:
 * @property Documents $documents
 * @property UserInfo $completedby0
 */
class DocumentQueues extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * I know this name does not follow best practice but it is required this way by yii.
	 * A better name would be getModel()
	 * @param string $className active record class name.
	 * @return Documents the static model class
	 */
	public static function model($className=__CLASS__)
	{
		// Return the model name.
	} // End of function model

	/** 
	 * I know this name does not follow best practice but it is required this way by yii.
	 * A better name would be getTableName()
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'ci_document_queues';
	} // End of function tableName

	/**
	 * I know this name does not follow best practice but it is required this way by yii.
	 * A better name would be setValidationRules()
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
	} // End of function rules
	
	/**
	 * Determine the model's relationship with other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
	} // End function relations

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
	} // End function attributeLabels
}