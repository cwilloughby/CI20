<?php
/* @var $this MyTickets */
/* @var $data TroubleTickets */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($this->customTruncate(strip_tags($data->description), 100)),
			array('tickets/troubletickets/view', 'id'=>$data->ticketid)); ?>
	<br/>
	<?php 
	$ticketComments = Comments::model()->with('ciTroubleTickets')->findAll(
		array(
			'condition'=>'ciTroubleTickets.ticketid=:selected_id', 
			'params'=>array(':selected_id'=>$data->ticketid),
			'order'=>'t.commentid DESC',
			'limit'=>1,
			'together'=>true
		)
	);

	if($ticketComments)
	{
		echo "<b>Last Comment:</b>";

		$this->render('_comments',array(
			'comments'=>$ticketComments,
		));
	}
	?>
</div>