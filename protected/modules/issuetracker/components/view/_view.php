<?php
/* @var $this MyTickets */
/* @var $data TroubleTickets */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode($this->customTruncate(strip_tags($data->description), 100)),
			array('tickets/troubletickets/view', 'id'=>$data->ticketid)); ?>
	<br/>

</div>