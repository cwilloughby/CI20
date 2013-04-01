<?php
/* @var $this GsTimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'GS Time Logs',
);

$this->menu2=array(
	array('label'=>'Create GS Time Log', 'url'=>array('create')),
	array('label'=>'Manage GS Time Log', 'url'=>array('admin')),
);
?>

<h1>GS Time Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
