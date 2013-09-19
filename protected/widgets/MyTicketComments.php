<?php
class MyTicketComments extends CPortlet 
{
    public $pageTitle = 'Create Comment';
	public $viewPath = '/views';
	public $ticket;
	
    /**
     * This function renders the ticket comments widget.
     */
    protected function renderContent()
	{
		$ticketComments = Comments::model()->with('ciTroubleTickets')->findAll(
			array(
				'condition'=>'ciTroubleTickets.ticketid=:selected_id', 
				'params'=>array(':selected_id'=>$this->ticket->ticketid),
				'order'=>'t.commentid DESC',
				'together'=>true
			)
		);

		$this->controller->renderPartial('_comments',array(
			'comments'=>$ticketComments,
		));
	}
}
