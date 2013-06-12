<?php

Yii::import('zii.widgets.CListView');

class CustomSmallListView extends CListView
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