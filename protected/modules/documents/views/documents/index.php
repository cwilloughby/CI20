<?php
/* @var $this DocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents',
);

$this->menu=array(
	array('label'=>'Search Documents', 'url'=>array('admin')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'List Documents', 'url'=>array('index')),
);
?>

<h1>Documents</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
