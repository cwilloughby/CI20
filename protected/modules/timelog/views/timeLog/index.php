<?php
/* @var $this TimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Time Logs',
);

$this->menu=array(
	array('label'=>'Manage Time Logs', 'url'=>array('admin')),
);
?>

<h1>Time Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
