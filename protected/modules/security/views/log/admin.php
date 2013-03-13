<?php
/* @var $this LogController */
/* @var $model Log */

$this->breadcrumbs=array(
	'Logs'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Logs', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('log-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Logs</h1>

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
	'id'=>'log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'eventid',
		array( 
			'name'=>'user_search', 
			'value'=>'$data->user->username' 
		),
		'tablename',
		'tablerow',
		'eventdate',
		'event',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
)); ?>
