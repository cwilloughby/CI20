<?php
/* @var $this NewsController */
/* @var $model News */

$this->pageTitle = Yii::app()->name . ' - Manage News Posts';

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'Search News Posts', 'url'=>array('admin')),
	array('label'=>'Create News Post', 'url'=>array('create')),
	array('label'=>'List News Posts', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('news-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search News</h1>

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
	'id'=>'news-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'newsid',
		array( 
			'name'=>'type_search', 
			'value'=>'$data->type->type' 
		),
		array( 
			'name'=>'user_search', 
			'value'=>'$data->postedby0->username' 
		),
		array(
			'name' => 'date',
			'value' => '(isset($data->date) && ((int)$data->date))
				?CHtml::encode(date("m/d/Y g:i a", strtotime($data->date))):"N/A"',
		),
		'news',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('news-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}',
		),
	),
)); ?>
