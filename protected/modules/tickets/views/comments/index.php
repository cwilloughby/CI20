<?php
/* @var $this CommentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Comments',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Comments', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Comments', 'url'=>array('index')),
);
?>

<h1>Comments</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array(
		'content',
		'datecreated',
	),
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}"
)); ?>
