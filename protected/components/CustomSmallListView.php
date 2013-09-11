<?php

Yii::import('zii.widgets.CListView');

/**
 * This class is a slightly customized listview with smaller labels for the pager buttons
 * and a reduced number of buttons that can be displayed at once.
 */
class CustomSmallListView extends CListView
{
    public function init()
	{
        parent::init();

        $this->pager = array( 
			'class' => 'CLinkPager', 
			'header' => '',
			'maxButtonCount'=>5,
			'firstPageLabel' => '<<', 
			'prevPageLabel' => '<', 
			'nextPageLabel' => '>', 
			'lastPageLabel' => '>>', 
	   );
    }
}
