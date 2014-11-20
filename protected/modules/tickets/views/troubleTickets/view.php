<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $ticketComments TicketComments */

$this->pageTitle = Yii::app()->name . ' - View Trouble Ticket';

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index', 'status'=>isset($model->closedbyuser)?'Closed':'Open'),
	$model->ticketid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index', 'status'=>'Open')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('index', 'status'=>'Closed')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Trouble Ticket', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'<i class="icon icon-pencil"></i> Update Trouble Ticket', 'url'=>array('update', 'id'=>$model->ticketid)),
	array('label'=>'<i class="icon icon-folder-open"></i> Reopen Trouble Ticket', 'url'=>array('#'), 'visible'=>$model->closedbyuserid != NULL,
			'linkOptions'=>(array('submit'=>array('reopen','id'=>$model->ticketid),'confirm'=>'Are you sure you want to reopen this ticket?'))),
);
?>

<h1>View Trouble Ticket #<?php echo $model->ticketid; ?></h1>

<?php 
if(Yii::app()->user->hasFlash('updated'))
{
	echo Yii::app()->user->getFlash('updated');
}

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ticketid',
		array(        
			'name'=>'openedby',
			'value'=>isset($model->openedby0)?CHtml::encode($model->openedby0->username):"Unknown"
		),
		array(        
			'name'=>'opendate',
			'value'=>isset($model->opendate)?CHtml::encode(date('g:i a m/d/Y', strtotime($model->opendate))):"N\\A"
		),
		array(        
			'name'=>'categoryid',
			'value'=>isset($model->category)?CHtml::encode($model->category->categoryname):"Unknown"
		),
		array(        
			'name'=>'subjectid',
			'value'=>isset($model->subject)?CHtml::encode($model->subject->subjectname):"Unknown"
		),
		array(
			'name'=>'description',
			'value'=>nl2br($model->description),
			'type'=>'raw',
		),
		array(        
			'name'=>'closedbyuserid',
			'value'=>isset($model->closedbyuser)?CHtml::encode($model->closedbyuser->username):"N\\A"
		),
		array(        
			'name'=>'closedate',
			'value'=>isset($model->closedate)?CHtml::encode(date('g:i a m/d/Y', strtotime($model->closedate))):"N\\A"
		),
		array(
			'name'=>'resolution',
			'value'=>nl2br($model->resolution),
			'type'=>'raw',
		),
	),
)); ?>

<div id="comments">
	
	<?php $this->widget('MyTicketComments', array('ticket' => $model)); ?>
	
	<?php
	// Only show the Manage Ticket form if the ticket is still open.
	if(is_null($model->closedbyuserid))
		$this->widget('ManageTicketWid', array('ticket' => $model)); 
	?>

</div>
