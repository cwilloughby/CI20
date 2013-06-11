<?php
/* @var $this GsTimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'GS Time Logs',
);

$this->menu2=array(
	array('label'=>'Search GS Time Log', 'url'=>array('admin')),
	array('label'=>'List GS Time Log', 'url'=>array('index')),
);
?>

<h1>GS Time Logs</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}"
)); ?>
