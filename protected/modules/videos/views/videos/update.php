<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Videos'=>array('index'),
	$model->title=>array('view','id'=>$model->videoid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Videos', 'url'=>array('admin')),
	array('label'=>'Upload Video', 'url'=>array('create')),
	array('label'=>'List Videos', 'url'=>array('index')),
	array('label'=>'View Videos', 'url'=>array('view', 'id'=>$model->videoid)),
);
?>

<h1>Update Video <?php echo $model->videoid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>