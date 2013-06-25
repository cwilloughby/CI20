<?php
/* @var $this LogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Logs',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Logs', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Logs', 'url'=>array('index')),
);
?>

<h1>Logs</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array(
		'user_search',
		'tablename',
		'eventdate',
		'event',
	),
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}"
)); ?>
