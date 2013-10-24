<?php

Yii::import('zii.widgets.grid.CGridView');

/**
 * This class is a slightly customized gridview with smaller labels for the pager buttons.
 */
class CustomGridView extends CGridView
{
    public function init()
	{
		parent::init();

		$this->pager = array( 
			'class' => 'CLinkPager',
			'header' => '',
			'firstPageLabel' => '<<', 
			'prevPageLabel' => '<', 
			'nextPageLabel' => '>', 
			'lastPageLabel' => '>>', 
		);
    }
}
