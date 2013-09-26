<?php

/**
 * This is the model class for table "ci_hr_policy".
 *
 * The followings are the available columns in table 'ci_hr_policy':
 * @property integer $policyid
 * @property string $policy
 */
class HrPolicy extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HrPolicy the static model class
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
		return 'ci_hr_policy';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// Define the validation rules in an array and return it.
		return array(
			array('policy', 'required'),
			array('policy', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('policyid, policy', 'safe', 'on'=>'search'),
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
			'policyid' => 'Policy ID',
			'policy' => 'Policy',
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
		$criteria->compare('policy',$this->policy,true);

		return new CActiveDataProvider($this, array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * The Accordion on the HR Policies page needs the policies and sections in one multi demensional array.
	 * This function builds that array.
	 * @return array
	 */
	public function CreateAccordionArray()
	{
		// Grab all of the policies.
		$policies = Yii::app()->db->createCommand()
			->select('ci_hr_policy.policyid, ci_hr_policy.policy')
			->from('ci_hr_policy')
			->queryAll();
		
		// Check if the user has access to edit the hr policy.
		$check = Yii::app()->user->checkAccess('hr@HrEdit', Yii::app()->user->id);
		
		// Loop through each policy
		foreach($policies as $policy)
		{
			// Grab all of the sections in the current policy.
			$sections = Yii::app()->db->createCommand()
				->select('ci_hr_policy.policyid, ci_hr_policy.policy, ci_hr_sections.sectionid, ci_hr_sections.section, ci_hr_sections.datemade')
				->from('ci_hr_policy')
				->leftJoin('ci_hr_sections','ci_hr_policy.policyid = ci_hr_sections.policyid')
				->where('ci_hr_sections.policyid=:id', array(':id'=>$policy['policyid']))
				->order('ci_hr_sections.datemade DESC')
				->queryAll();
			
			$first = 0;
			
			// Loop through each section in the current policy.
			foreach($sections as $section)
			{
				// If the currect section is the first, add the section's create date and the word "Current"
				// to the label.
				if($first == 0)
				{
					$sectionKey = date('M d, Y', strtotime($section['datemade'])) . " Current";
					$first = 1;
				}
				// Otherwise, add the section's create date and the word "Old" to the label.
				else
					$sectionKey = date('M d, Y', strtotime($section['datemade'])) . " Old";
				
				// If the user has the rights to edit the hr policy.
				if($check)
				{
					// Add an edit link to the sub panel.
					$panels[$policy['policy']][$sectionKey] = CHtml::link('Edit',
						array('hrpolicy/updatesection?policyid=' . $policy['policyid'] 
							. "&sectionid=" .$section['sectionid'])) . "<br/><br/>" . $section['section'];
				}
				else
					$panels[$policy['policy']][$sectionKey] = $section['section'];
			}
			
			// If the user has the rights to edit the hr policy.
			if($check)
			{
				// Create the section model.
				$nSection = new HrSections;
				// Take the create policy form and put it into the last main panel.
				$nSection->policyid = $policy['policyid'];
				$panels[$policy['policy']]['Create New Section'] =
					Yii::app()->controller->renderPartial('_formSection', array('model'=>$nSection), true);
			}
		}
		
		return $panels;
	}
}