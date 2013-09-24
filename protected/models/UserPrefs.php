<?php

/**
 * This is the model class for table "ci_user_prefs".
 *
 * The followings are the available columns in table 'ci_user_prefs':
 * @property integer $userid
 * @property string $color
 *
 * The followings are the available model relations:
 * @property UserInfo $user
 */
class UserPrefs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserPrefs the static model class
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
		return 'ci_user_prefs';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('userid', 'required'),
			array('userid', 'numerical', 'integerOnly'=>true),
			array('color', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('userid, color', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'UserInfo', 'userid'),
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
			'userid' => 'User ID',
			'color' => 'Color',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('userid',$this->userid);
		$criteria->compare('color',$this->color,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Obtain the user's color preference from the database and sets it in a cookie.
	 */
	public static function setUserColor()
	{
		$color = Yii::app()->db->createCommand()
			->select('ci_user_prefs.color')
			->from('ci_user_prefs')
			->where('ci_user_prefs.userid=:id', array(':id'=>Yii::app()->user->id))
			->queryAll();

		// If the user's color preference cookie is not set, set it here.
		if(array_key_exists(0, $color) && array_key_exists('color', $color[0]))
		{
			setcookie("style", $color[0]['color'], time()+604800, '/'); // 604800 = amount of seconds in one week
		}
	}
}