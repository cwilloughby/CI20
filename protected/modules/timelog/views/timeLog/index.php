<?php
/* @var $this TimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . " - Time Log";

$this->breadcrumbs=array(
	'Time Logs',
);

$this->menu2=array(
	array('label'=>'Search Time Logs', 'url'=>array('admin')),
	array('label'=>'List Time Logs', 'url'=>array('index')),
);
?>

<h1>Time Logs</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}"
)); ?>
