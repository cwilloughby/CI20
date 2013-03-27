<?php
/* @var $this GsTimeLogController */
/* @var $model GsTimeLog */

$this->breadcrumbs=array(
	'Gs Time Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GsTimeLog', 'url'=>array('index')),
	array('label'=>'Create GsTimeLog', 'url'=>array('create')),
	array('label'=>'View GsTimeLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GsTimeLog', 'url'=>array('admin')),
);
?>

<h1>Update GsTimeLog <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>