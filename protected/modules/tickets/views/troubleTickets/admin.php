<?php
/* @var $this TroubleTicketsController */
/* @var $model TroubleTickets */

$this->breadcrumbs=array(
	'Trouble Tickets'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'List Open Trouble Tickets', 'url'=>array('index')),
	array('label'=>'Closed Trouble Tickets', 'url'=>array('closedindex')),
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
			'template'=>'{view}{update}',
		),
	),
)); ?>
