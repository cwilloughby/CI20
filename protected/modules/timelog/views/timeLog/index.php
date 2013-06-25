<?php
/* @var $this TimeLogController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . " - Time Log";

$this->breadcrumbs=array(
	'Time Logs',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Time Logs', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Time Logs', 'url'=>array('index')),
);
?>

<h1>Time Logs</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}"
)); ?>
