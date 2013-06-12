<?php
/**
 * This class is for the my tickets porlet.
 */
class MyTickets extends CPortlet
{
	public $pageTitle = 'Training';
	
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
				$dataProvider=new CActiveDataProvider('TroubleTickets', 
					array(
						'criteria'=>array(
							'condition'=> 'closedbyuserid IS NULL AND openedby= ' . Yii::app()->user->id
						),
						'sort'=>array(
							'defaultOrder'=>array(
								'ticketid'=>CSort::SORT_ASC,
							),
						),
					)
				);
			}
			else
			{
				// Only show tickets that this user has closed.
				$dataProvider=new CActiveDataProvider('TroubleTickets', 
					array(
						'pagination'=>array(
							'pageSize'=>2
						),
						'criteria'=>array(
							'condition'=>'openedby= ' . Yii::app()->user->id . ' AND closedbyuserid IS NOT NULL'
						),
						'sort'=>array(
							'defaultOrder'=>array(
								'ticketid'=>CSort::SORT_ASC,
							),
						),
					)
				);
			}

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
