<?php
/**
 * This class is for the my tickets porlet.
 */
class MyTickets extends CPortlet
{
	public $pageTitle = 'Tickets';
	public $viewPath = '/views';
	public $status = "Open";
	
	/**
	 * This function renders the tickets widget.
	 */
	protected function renderContent()
	{
		if(isset(Yii::app()->user->id))
		{
			if($this->status == "Open")
			{
				// Only show tickets that this user has open.
				$condition = 't.closedbyuserid IS NULL AND t.openedby= ' . Yii::app()->user->id;
			}
			else
			{
				// Only show tickets that this user has closed.
				$condition = 'openedby= ' . Yii::app()->user->id . ' AND closedbyuserid IS NOT NULL';
			}

			$dataProvider=new CActiveDataProvider('TroubleTickets', 
				array(
					'pagination'=>array(
						'pageSize'=>4
					),
					'criteria'=>array(
						'condition'=>$condition,
					),
					'sort'=>array(
						'defaultOrder'=>array(
							'ticketid'=>CSort::SORT_ASC,
						),
					),
				)
			);
			
			$this->render('mytickets',array(
				'dataProvider'=>$dataProvider,
				'status'=>$this->status
			));
		}
	}
	
	/**
	 * This function takes a string and a number for the maximum length.
	 * If the string is greater than the allowed length, the string will be shortend
	 * to fit the length and "..." characters will be added to the end of the shortend string.
	 * @param Array $text
	 * @param Integer $length
	 * @return Array
	 */
	public function customTruncate($text, $length)
	{
		$length = abs((int)$length);
		if(strlen($text) > $length) {
			$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text);
		}
		return $text;
	}
}
