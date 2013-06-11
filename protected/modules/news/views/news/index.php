<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News',
);

$this->menu2=array(
	array('label'=>'Search News Posts', 'url'=>array('admin')),
	array('label'=>'Create News Post', 'url'=>array('create')),
	array('label'=>'List News Posts', 'url'=>array('index')),
);
?>

<h1>News</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
	'sortableAttributes'=>array(
		'date',
	),
)); ?>
