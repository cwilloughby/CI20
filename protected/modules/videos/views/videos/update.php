<?php
/* @var $this VideosController */
/* @var $model Videos */

$this->breadcrumbs=array(
	'Videoses'=>array('index'),
	$model->title=>array('view','id'=>$model->videoid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List Videos', 'url'=>array('index')),
	array('label'=>'Create Videos', 'url'=>array('create')),
	array('label'=>'View Videos', 'url'=>array('view', 'id'=>$model->videoid)),
	array('label'=>'Manage Videos', 'url'=>array('admin')),
);
?>

<h1>Update Videos <?php echo $model->videoid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>