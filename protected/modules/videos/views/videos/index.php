<?php
/* @var $this VideosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Videos',
);

$this->menu2=array(
	array('label'=>'Search Videos', 'url'=>array('admin')),
	array('label'=>'Upload Video', 'url'=>array('create')),
	array('label'=>'List Videos', 'url'=>array('index')),
);
?>

<h1>Videos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
