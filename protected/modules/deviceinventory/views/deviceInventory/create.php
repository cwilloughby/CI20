<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */

$this->pageTitle = Yii::app()->name . ' - Create Inventory Item';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Inventory', 'url'=>array('search')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
);
?>

<h1>Create Inventory Item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>