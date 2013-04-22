<?php
/* @var $this TroubleTicketsController */
/* @var $data TroubleTickets */
?>

<div class="view">
	<table>
		<tr>
			<td>
			<table>
				<tr>
					<td>
					<?php echo CHtml::link('View Ticket', array('view', 'id'=>$data->ticketid)); ?>
					&emsp;-&emsp;
					<?php echo CHtml::link('Close Trouble Ticket', array('close', 'id'=>$data->ticketid)); ?>
					<br/>

					<b><?php echo CHtml::encode($data->getAttributeLabel('ticketid')); ?>:</b>
					<?php echo CHtml::encode($data->ticketid); ?>
					<br/>

					<b><?php echo CHtml::encode($data->getAttributeLabel('openedby')); ?>:</b>
					<?php echo CHtml::encode($data->openedby0->username); ?>
					<br/>

					<b><?php echo CHtml::encode($data->getAttributeLabel('opendate')); ?>:</b>
					<?php echo CHtml::encode(date('g:i a m/d/Y', strtotime($data->opendate))); ?>
					<br/>

					<b><?php echo CHtml::encode($data->getAttributeLabel('categoryid')); ?>:</b>
					<?php echo CHtml::encode($data->category->categoryname); ?>
					<br/>

					<b><?php echo CHtml::encode($data->getAttributeLabel('subjectid')); ?>:</b>
					<?php echo CHtml::encode($data->subject->subjectname); ?>
					<br/>

					<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
					<?php echo nl2br($data->description); ?>
					</td>
				</tr>
			</table>
			</td>
			<td style="vertical-align: text-top;">
			<table>
				<tr>
					<td>
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
						
						$this->renderPartial('_comments',array(
							'comments'=>$ticketComments,
						));
					}
					?>
					</td>
				</tr>
			</table>
			</td>
		</tr>
	</table>
</div>
