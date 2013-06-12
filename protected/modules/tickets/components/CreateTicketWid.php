<?php
/**
 * This class is for the weather porlet. 
 * This allows the login form to be displayed on the home page.
 */
class CreateTicketWid extends CPortlet
{
	public $pageTitle = 'Training';
	
	/**
	 * This function renders the training resources widget.
	 */
	protected function renderContent()
	{
		$ticket=new TroubleTickets;
		$file=new Documents;
		
		if(isset($_POST['ajax']) && $_POST['ajax']==='trouble-tickets-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		
		if(isset($_POST['TroubleTickets']))
		{
			$ticket->attributes=$_POST['TroubleTickets'];
			$file->attributes=$_POST['Documents'];
			
			// Validate BOTH $ticket and $file at the same time.
			$valid=$ticket->validate() && $file->validate();
		
			if($valid)
			{
				$file->attachment=CUploadedFile::getInstance($file,'attachment');
				
				// Remove the first two elements and the last two elements from the POST array
				// to isolate the conditionals.
				array_shift($_POST);
				array_shift($_POST);
				array_pop($_POST);
				array_pop($_POST);

				$ticket->description .= "\n\n";
				
				// Grab all the data from the conditionals and put them in the description.
				foreach($_POST as $key => $value) 
					$ticket->description .= $key . ": " . $value . "\n";
				
				$temp = $ticket->description;
				
				if(isset($file->attachment))
				{
					$file->save(false);
					// This description will only allow the link to work on the website.
					$ticket->description .= "\nAttachment: " 
						. CHtml::link($file->documentname,array('/../../../../assets/uploads/' 
							. $file->uploaddate . '/' . $file->documentname));
					// This description will only be used for the email so the link will work.
					$temp .= "\nAttachment: <a href='file:///" . $file->path . "'>" . $file->documentname . "</a>";
				}
				else
					$temp .= "\n";
				
				$ticket->save(false);
				
				// Remove the flash message so the email will work again.
				Yii::app()->user->getFlash('success');
				
				$this->controller->redirect(
					array('/email/email/helpopenemail', 
						'ticketid' => $ticket->ticketid,
						'category' => $ticket->categoryid,
						'subject' => $ticket->subjectid,
						'description' => $temp,
					));
			}
		}
		
		$this->render('_form',array(
			'ticket'=>$ticket,
			'file'=>$file,
		));
	}
	
	/**
	 * This function takes a string and a number for the maximum length.
	 * If the string is greater than the allowed length, the string will be shortend
	 * to fit the length and "..." characters will be added to the end of the shortend string.
	 * @param Array $text
	 * @param Integer $length
	 * @return Array
	 */
	private function customTruncate($text, $length)
	{
		foreach($text as $key => $value)
		{
			$length = abs((int)$length);
			if(strlen($text[$key]) > $length) {
				$text[$key] = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text[$key]);
			}
		}
		return $text;
	}
}
