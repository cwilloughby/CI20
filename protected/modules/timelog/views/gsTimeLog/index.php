<?php
/* @var $this GsTimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gs Time Logs',
);

$this->menu=array(
	array('label'=>'Create GsTimeLog', 'url'=>array('create')),
	array('label'=>'Manage GsTimeLog', 'url'=>array('admin')),
);
?>

<h1>Gs Time Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
