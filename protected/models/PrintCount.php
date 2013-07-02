<?php

/**
 * This is the model class for table "ci_print_count".
 *
 * The followings are the available columns in table 'ci_print_count':
 * @property integer $id
 * @property string $date
 * @property integer $machineid
 * @property integer $starttotal
 * @property integer $endtotal
 */
class PrintCount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PrintCount the static model class
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
		return 'ci_print_count';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('date', 'required'),
			array('machineid, starttotal, endtotal', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, date, machineid, starttotal, endtotal', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'date' => 'Date',
			'machineid' => 'Machineid',
			'starttotal' => 'Start Total',
			'endtotal' => 'End Total',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('machineid',$this->machineid);
		$criteria->compare('starttotal',$this->starttotal);
		$criteria->compare('endtotal',$this->endtotal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}