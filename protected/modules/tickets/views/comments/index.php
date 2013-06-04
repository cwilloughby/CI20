<?php
/* @var $this CommentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comments',
);

$this->menu2=array(
	array('label'=>'Search Comments', 'url'=>array('admin')),
	array('label'=>'List Comments', 'url'=>array('index')),
);
?>

<h1>Comments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array(
		'content',
		'datecreated',
	),
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}"
)); ?>
