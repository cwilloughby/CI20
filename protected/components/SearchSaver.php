<?php
/*
 * This class is used to define a custom model behavior that retains search parameters
 * between page loads.
 */
class SearchSaver extends CActiveRecordBehavior
{
	public function readSearchValues()
	{
		$modelName=get_class($this->owner);
		$attributes=$this->owner->getSafeAttributeNames();

		foreach($attributes as $attribute)
		{
			if(null!=($value=Yii::app()->user->getState($modelName.$attribute,null)))
				$this->owner->$attribute=$value;
		}
	}

	public function saveSearchValues()
	{
		$modelName=get_class($this->owner);
		$attributes=$this->owner->getSafeAttributeNames();
		foreach($attributes as $attribute)
		{
			Yii::app()->user->setState($modelName.$attribute,1,1);
			Yii::app()->user->setState($modelName.$attribute,$this->owner->$attribute);
		}
	}
}
