<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search News Posts', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create News Post', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List News Posts', 'url'=>array('index')),
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
