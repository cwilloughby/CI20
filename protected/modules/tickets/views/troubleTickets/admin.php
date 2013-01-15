<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
	array('label'=>'Create Trouble Ticket', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('trouble-tickets-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Trouble Tickets</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'trouble-tickets-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ticketid',
		array( 
			'name'=>'openedby', 
			'value'=>'$data->openedby0->username' 
		),
		'opendate',
		array( 
			'name'=>'category', 
			'value'=>'$data->category->categoryname' 
		),
		array(
			'name'=>'subject', 
			'value'=>'$data->subject->subjectname' 
		),
		'description',
		array( 
			'name'=>'closedbyuserid', 
			'value'=>'(isset($data->closedbyuser->username)) 
						? $data->closedbyuser->username 
						: ""'
		),
		'closedate',
		'resolution',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
