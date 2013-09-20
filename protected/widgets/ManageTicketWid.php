<?php
class ManageTicketWid extends CPortlet 
{
    public $pageTitle = 'Ticket Manager';
	public $viewPath = '/views';
	public $ticket;
	
    /**
     * This function renders the manage ticket widget.
     */
    protected function renderContent()
	{
		try
		{
			$ticketManager = new ManageTicket;
			$file = new Documents;

			if(Yii::app()->request->getPost('ManageTicket'))
			{
				if(isset($_POST['submittype']))
				{
					// If the user is trying to submit a new comment.
					if($_POST['submittype'] == 'comment')
					{
						$_GET['ticket'] = $this->ticket;
						$ticketManager = CommentsController::createComment();
					}
					// If the user is trying to close the ticket.
					else if($_POST['submittype'] == 'close')
					{
						$_GET['ticket'] = $this->ticket;
						$ticketManager = TroubleTicketsController::closeTicket();
					}
					else
						throw new Exception("Invalid submit type was provided.");
				}
				else
					throw new Exception("No submit type was provided.");
			}
		}
		catch(Exception $ex)
		{
			echo "Ticket manager failed with error " . $ex;
		}
		
		$this->render('_manageTicket',array(
			'model'=>$ticketManager, 'file'=>$file
		));
	}
}