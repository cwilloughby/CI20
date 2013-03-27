<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List TimeLog', 'url'=>array('index')),
	array('label'=>'Manage TimeLog', 'url'=>array('admin')),
);
?>

<h1>Create TimeLog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>