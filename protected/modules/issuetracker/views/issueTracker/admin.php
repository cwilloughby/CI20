<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->breadcrumbs=array(
	'Issue Tracker'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'Search CJIS Issues', 'url'=>array('admin')),
	array('label'=>'Create CJIS Issue', 'url'=>array('create')),
	array('label'=>'List CJIS Issues', 'url'=>array('index')),
	array('label'=>'Change Priority Order', 'url'=>array('changepriorities')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('issue-tracker-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search CJIS Issues</h1>

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

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'issue-tracker-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'key',
		'type',
		'created',
		'summary',
		/*
		'assigned',
		'updated',
		'originalestimate',
		'remainingestimate',
		'timespent',
		'resolution',
		'priority',
		*/
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('issue-tracker-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view} {update}',
		),
	),
)); ?>