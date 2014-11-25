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
		return parent::model($className);
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
		return array(
			array('queue', 'required'),
			array('documentid, completedby', 'numerical', 'integerOnly'=>true),
			array('queue', 'length', 'max'=>45),
			array('completiondate', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('itemid, queue, documentid, completedby, completiondate', 'safe', 'on'=>'search'),
		);
	} // End of function rules
	
	/**
	 * Determine the model's relationship with other models.
	 * @return array relational rules.
	 */
	public function relations()
	{
		// Return an array of defined relationships.
		return array(
            'completedby0' => array(self::BELONGS_TO, 'UserInfo', 'completedby'),
            'document' => array(self::BELONGS_TO, 'Documents', 'documentid'),
        );
	} // End function relations

	/**
	 * Determine the attribute labels that will be shown to the users.
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		// Return an array of attribute labels.
		return array(
            'itemid' => 'Itemid',
            'queue' => 'Queue',
            'documentid' => 'Documentid',
            'completedby' => 'Completedby',
            'completiondate' => 'Completiondate',
        );
	} // End function attributeLabels
	
	/**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;

        $criteria->compare('itemid',$this->itemid);
        $criteria->compare('queue',$this->queue,true);
        $criteria->compare('documentid',$this->documentid);
        $criteria->compare('completedby',$this->completedby);
        $criteria->compare('completiondate',$this->completiondate,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}