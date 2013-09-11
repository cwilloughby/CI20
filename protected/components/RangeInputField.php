<?php
/**
 * This is a custom form field for a date range.
 */
class RangeInputField extends CInputWidget
{
	public $attributeFrom;
	public $attributeTo;

	public $nameFrom;
	public $nameTo;

	public $valueFrom;
	public $valueTo;

	protected function hasModel()
	{
		return $this->model instanceof CModel && $this->attributeFrom!==null && $this->attributeTo!==null;
	}
	
	function run()
	{
		if($this->hasModel())
		{
			echo "<b>From: </b>";
			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=> get_class($this->model) . '[' . $this->attributeFrom . ']',  // name of post parameter
				'model'=>$this->model,
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy', 
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;'
				),
			));
			
			echo ' <b>To: </b>';
			
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
				'name'=> get_class($this->model) . '[' . $this->attributeTo . ']',
				'model'=>$this->model,
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy', 
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				),
				'htmlOptions'=>array(
					'style'=>'height:20px;'
				),
			));
		}
		else 
		{
			echo $this->form->textField($this->nameFrom, $this->valueFrom);
			echo ' To: ';
			echo $this->form->textField($this->nameTo, $this->valueTo);
		}
	}
}