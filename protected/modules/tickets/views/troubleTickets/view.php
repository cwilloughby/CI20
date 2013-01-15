<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	$model->ticketid,
);

$this->menu=array(
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'Create Trouble Ticket', 'url'=>array('create')),
	array('label'=>'Update Trouble Ticket', 'url'=>array('update', 'id'=>$model->ticketid)),
	($model->closedbyuserid == NULL 
		? array('label'=>'Close Trouble Ticket', 'url'=>array('close', 'id'=>$model->ticketid))
		: array('label'=>'Reopen Trouble Ticket', 'url'=>'#', 
			'linkOptions'=>(array('submit'=>array('reopen','id'=>$model->ticketid),'confirm'=>'Are you sure you want to reopen this ticket?')))),
	
	array('label'=>'Manage Trouble Tickets', 'url'=>array('admin')),
);
?>

<h1>View Trouble Ticket #<?php echo $model->ticketid; ?></h1>

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
			'value'=>isset($model->opendate)?CHtml::encode(date('g:i a Y-m-d', strtotime($model->opendate))):"N\\A"
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
		array(        
			'name'=>'closedbyuserid',
			'value'=>isset($model->closedbyuser)?CHtml::encode($model->closedbyuser->username):"N\\A"
		),
		array(        
			'name'=>'closedate',
			'value'=>isset($model->closedate)?CHtml::encode(date('g:i a Y-m-d', strtotime($model->closedate))):"N\\A"
		),
		'resolution',
	),
)); ?>

<div id="comments">
	<?php if($ticketComments): ?>
		<?php $this->renderPartial('_comments',array(
			'comments'=>$ticketComments,
		)); ?>
	<?php endif; ?>

	<br/><h3>Leave a Comment</h3>

	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
	</div>
	<?php else: ?>
		<?php $this->renderPartial('/comments/_form',array(
			'model'=>$comment,
		)); ?>
	<?php endif; ?>

</div>
