<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */
/* @var $ticketComments TicketComments */

$this->pageTitle = Yii::app()->name . ' - Close Trouble Ticket';

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index', 'status'=>'Open')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('index', 'status'=>'Closed')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Trouble Ticket', 'url'=>array('view', 'id'=>$model->ticketid)),
	array('label'=>'<i class="icon icon-pencil"></i> Update Trouble Ticket', 'url'=>array('update', 'id'=>$model->ticketid)),
);
?>

<h1>Close Trouble Ticket #<?php echo $model->ticketid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
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
		'description',
	),
)); ?>

<div id="comments">
	<?php if($ticketComments): ?>
		<?php $this->renderPartial('_comments',array(
			'comments'=>$ticketComments,
		)); ?>
	<?php endif; ?>
</div>

<?php $this->renderPartial('_closeTicket',array(
	'model'=>$model,
)); ?>
