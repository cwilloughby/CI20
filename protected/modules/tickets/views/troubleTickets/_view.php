<?php
/* @var $this TroubleTicketsController */
/* @var $data TroubleTickets */
?>

<div class="view">
	<div class="row-fluid">
		<div class="span6">

			<h5><?php echo CHtml::encode($data->getAttributeLabel('ticketid')); ?>:
			<?php echo CHtml::encode($data->ticketid); ?>
			<h5/>

			<h5>
			<?php echo CHtml::encode($data->getAttributeLabel('openedby')); ?>:
			<?php echo CHtml::encode($data->openedby0->username); ?>
			&emsp;-&emsp;
			<?php echo CHtml::encode($data->getAttributeLabel('opendate')); ?>:
			<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->opendate))); ?>
			</h5>

			<?php
			if($_GET['status'] == 'Closed')
			{
				?>
				<h5>
				<?php echo CHtml::encode($data->getAttributeLabel('closedbyuserid')); ?>:
				<?php echo CHtml::encode($data->closedbyuser->username); ?>
				&emsp;-&emsp;
				<?php echo CHtml::encode($data->getAttributeLabel('closedate')); ?>:
				<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->closedate))); ?>
				</h5>
				<?php
			}
			?>
			
			<h5>
			<?php echo CHtml::encode($data->getAttributeLabel('categoryid')); ?>:
			<?php echo CHtml::encode($data->category->categoryname); ?>
			&emsp;-&emsp;
			<?php echo CHtml::encode($data->getAttributeLabel('subjectid')); ?>:
			<?php echo CHtml::encode($data->subject->subjectname); ?>
			</h5>

			<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
			<?php echo nl2br($data->description); ?>
			
			<h4>
			<?php echo CHtml::link('View Ticket', array('view', 'id'=>$data->ticketid));
			if($_GET['status'] != 'Closed')
			{
				?>
				&emsp;-&emsp;
				<?php echo CHtml::link('Close Ticket', array('close', 'id'=>$data->ticketid));
			}
			?>
			</h4>
		</div>
		<div class="span6">
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

			echo "<h4>Last Comment:</h4>";
			
			if($ticketComments)
			{
				$this->renderPartial('_comments',array(
					'comments'=>$ticketComments,
				));
			}
			else
				echo "<h5>No comments have been made.</h5>";
			?>
		</div>
	</div>
</div>
