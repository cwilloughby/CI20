<?php
/* @var $this DeviceInventoryController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - List Inventory';

$this->breadcrumbs=array(
	'Device Inventory',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Inventory', 'url'=>array('search')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
);
?>

<h1>Device Inventories</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}",
)); ?>
