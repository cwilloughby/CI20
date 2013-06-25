<?php
/* @var $this VideosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Videos',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Videos', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Video', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Videos', 'url'=>array('index')),
);
?>

<h1>Videos</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
