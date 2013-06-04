<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->pageTitle = Yii::app()->name . ' - Manage Comments';

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'Search Comments', 'url'=>array('admin')),
	array('label'=>'List Comments', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('comments-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Search Comments</h1>

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
	'id'=>'comments-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		array( 
			'name'=>'user_search', 
			'value'=>'$data->createdby0->username' 
		),
		array(
			'name' => 'datecreated',
			'value' => 'DATE("m/d/Y g:i a", STRTOTIME("$data->datecreated"))',
		),
		'content',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('comments-grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
