<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$model->title,
);

$this->menu2=array(
	array('label'=>'Search Videos', 'url'=>array('admin')),
	array('label'=>'Upload Video', 'url'=>array('create')),
	array('label'=>'List Videos', 'url'=>array('index')),
	array('label'=>'View Videos', 'url'=>array('view', 'id'=>$model->videoid)),
	array('label'=>'Update Videos', 'url'=>array('update', 'id'=>$model->videoid)),
	array('label'=>'Delete Videos', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->videoid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Video #<?php echo $model->videoid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'videoid',
		'documentid',
		'title',
		'type',
	),
)); ?>
