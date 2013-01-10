<?php

/**
 * This is the model class for table "ci_comments".
 *
 * The followings are the available columns in table 'ci_comments':
 * @property integer $commentid
 * @property string $content
 * @property integer $createdby
 * @property string $datecreated
 *
 * The followings are the available model relations:
 * @property TicketComments $comment
 * @property UserInfo $createdby0
 */
class Comments extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comments the static model class
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
		return 'ci_comments';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('content, createdby, datecreated', 'required'),
			array('createdby', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('commentid, content, createdby, datecreated', 'safe', 'on'=>'search'),
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
			'comment' => array(self::BELONGS_TO, 'TicketComments', 'commentid'),
			'createdby0' => array(self::BELONGS_TO, 'UserInfo', 'createdby'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'commentid' => 'Commentid',
			'content' => 'Content',
			'createdby' => 'Createdby',
			'datecreated' => 'Datecreated',
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

		$criteria->compare('commentid',$this->commentid);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('createdby',$this->createdby);
		$criteria->compare('datecreated',$this->datecreated,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}