<?php
/* @var $this VideosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Training Resources',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Training Resources', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-film"></i> Upload Training Resource', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Training Resources', 'url'=>array('index')),
);
?>

<h1>Training Resources</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
