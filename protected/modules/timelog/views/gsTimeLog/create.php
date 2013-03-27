<?php
/* @var $this GsTimeLogController */
/* @var $model GsTimeLog */

$this->breadcrumbs=array(
	'Gs Time Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GsTimeLog', 'url'=>array('index')),
	array('label'=>'Manage GsTimeLog', 'url'=>array('admin')),
);
?>

<h1>Create GsTimeLog</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>