<?php

Yii::import('zii.widgets.grid.CGridView');

class CustomGridView extends CGridView
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
