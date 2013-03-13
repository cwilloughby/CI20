<?php
/* @var $this LogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Logs',
);

$this->menu=array(
	array('label'=>'Manage Logs', 'url'=>array('admin')),
);
?>

<h1>Logs</h1>

<?php $this->widget('zii.widgets.CListView', array(
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
