<?php
/*
 * This class is used to define a custom model behavior that retains search parameters
 * between page loads.
 */
class SearchSaver extends CActiveRecordBehavior
{
	/**
	 * This function is used to load up saved search parameters for the desired search.
	 * This is used to retain search parameter between page loads.
	 * @param type $searchName
	 */
	public function readSearchValues($searchName)
	{
		$modelName=get_class($this->owner);
		$attributes=$this->owner->getSafeAttributeNames();

		foreach($attributes as $attribute)
		{
			if(null!=($value=Yii::app()->user->getState($searchName.$modelName.$attribute,null)))
				$this->owner->$attribute=$value;
		}
	}

	/**
	 * This function is used to save search parameters for the desired search.
	 * This is used to retain search parameter between page loads.
	 * @param type $searchName
	 */
	public function saveSearchValues($searchName)
	{
		$modelName=get_class($this->owner);
		$attributes=$this->owner->getSafeAttributeNames();
		foreach($attributes as $attribute)
		{
			Yii::app()->user->setState($searchName.$modelName.$attribute,1,1);
			Yii::app()->user->setState($searchName.$modelName.$attribute,$this->owner->$attribute);
		}
	}
}
