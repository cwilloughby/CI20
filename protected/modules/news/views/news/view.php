<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->newsid,
);

$this->menu2=array(
	array('label'=>'Search News Posts', 'url'=>array('admin')),
	array('label'=>'Create News Post', 'url'=>array('create')),
	array('label'=>'List News Posts', 'url'=>array('index')),
	array('label'=>'View News Post', 'url'=>array('view', 'id'=>$model->newsid)),
	array('label'=>'Update News Post', 'url'=>array('update', 'id'=>$model->newsid)),
	array('label'=>'Delete News Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->newsid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View News #<?php echo $model->newsid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(        
			'name'=>'typeid',
			'value'=>isset($model->type)?CHtml::encode($model->type->type):"Unknown"
		),
		array(        
			'name'=>'postedby',
			'value'=>isset($model->postedby0)?CHtml::encode($model->postedby0->username):"Unknown"
		),
		array(        
			'name'=>'date',
			'value'=>isset($model->date)?CHtml::encode(date('g:i a m/d/Y', strtotime($model->date))):"N\\A"
		),
		'news',
	),
)); ?>
