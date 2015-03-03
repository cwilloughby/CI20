<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */

$this->pageTitle = Yii::app()->name . ' - Create Inventory Item';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Inventory Report', 'url'=>array('reportInventory')),
	array('label'=>'<i class="icon icon-search"></i> Assignment Report', 'url'=>array('reportAssignments')),
	array('label'=>'<i class="icon icon-search"></i> Historic Report', 'url'=>array('devicehistoric/reportHistoric')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-file"></i> Upload Inventory Changes', 'url'=>array('importChangesViaBarcodes')),
);
?>

<h1>Create Inventory Item</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>