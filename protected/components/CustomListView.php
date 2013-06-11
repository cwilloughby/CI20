<?php

Yii::import('zii.widgets.CListView');

class CustomListView extends CListView
{
    public function init()
	{
        parent::init();

        $this->pager = array( 
			'class' => 'CLinkPager', 
			'firstPageLabel' => '<<', 
			'prevPageLabel' => '<', 
			'nextPageLabel' => '>', 
			'lastPageLabel' => '>>', 
	   );
    }
}
