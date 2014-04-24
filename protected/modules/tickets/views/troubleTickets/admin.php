<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->pageTitle = Yii::app()->name . ' - Search Trouble Tickets';

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Trouble Tickets', 'url'=>array('admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-eye-open"></i> List Open Trouble Tickets', 'url'=>array('index', 'status'=>'Open')),
	array('label'=>'<i class="icon icon-eye-close"></i> List Closed Trouble Tickets', 'url'=>array('index', 'status'=>'Closed')),
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

<h1>Search Trouble Tickets</h1>

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

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('CustomGridView', array(
	'id'=>'trouble-tickets-grid',
	'dataProvider'=>$model->search(),
	'filter'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id) ? $model : null),
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'ticketid',
		array( 
			'name'=>'user_search',
			'value'=>'$data->openedby0->username',
		),
		array(
			'name' => 'opendate',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->opendate"))',
		),
		array( 
			'name'=>'category_search', 
			'value'=>'$data->category->categoryname',
		),
		array(
			'name'=>'subject_search', 
			'value'=>'$data->subject->subjectname',
		),
		'description',
		array( 
			'name'=>'closer_search', 
			'value'=>'(isset($data->closedbyuser->username)) 
						? $data->closedbyuser->username 
						: ""',
		),
		array(
			'name' => 'closedate',
			'value' => '(isset($data->closedate) && ((int)$data->closedate))
				?CHtml::encode(date("m/d/Y g:i a", strtotime($data->closedate))):"N/A"',
		),
		'resolution',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('trouble-tickets-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}',
		),
	),
)); ?>
