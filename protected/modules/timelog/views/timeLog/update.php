<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List TimeLog', 'url'=>array('index')),
	array('label'=>'Create TimeLog', 'url'=>array('create')),
	array('label'=>'View TimeLog', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage TimeLog', 'url'=>array('admin')),
);
?>

<h1>Update TimeLog <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>