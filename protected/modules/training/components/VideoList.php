<?php

class VideoList extends CustomListView
{
	public $columnCount = 2;

	/**
	 * Renders the data item list.
	 */
	public function renderItems()
	{
		echo CHtml::openTag('table');
		
		$data=$this->dataProvider->getData();
		if(($n=count($data))>0)
		{
			$owner=$this->getOwner();
			$viewFile=$owner->getViewFile($this->itemView);
			$column = 0;
			foreach($data as $i=>$item)
			{
				if($column == 0)
					echo CHtml::openTag('tr');
				$data=$this->viewData;
				$data['index']=$i;
				$data['data']=$item;
				$data['widget']=$this;
				$owner->renderFile($viewFile,$data);
				$column++;
				if($column == $this->columnCount)
				{
					$column = 0;
					echo CHtml::closeTag('tr');
				}
			}
		}
		else
			$this->renderEmptyText();
			
		echo CHtml::closeTag('table');
		
	}
}
