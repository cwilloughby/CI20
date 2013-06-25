<?php
/* @var $this GsTimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'GS Time Logs',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search GS Time Log', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List GS Time Log', 'url'=>array('index')),
);
?>

<h1>GS Time Logs</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}"
)); ?>
