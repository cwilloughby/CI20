<?php

Yii::import('zii.widgets.CListView');

/**
 * This class is a slightly customized listview with smaller labels for the pager buttons.
 */
class CustomListView extends CListView
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
