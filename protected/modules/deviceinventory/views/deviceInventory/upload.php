<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */

$this->pageTitle = Yii::app()->name . ' - Upload Changes From Barcodes';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	'Upload',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Inventory Report', 'url'=>array('reportInventory')),
	array('label'=>'<i class="icon icon-search"></i> Assignment Report', 'url'=>array('reportAssignments')),
	array('label'=>'<i class="icon icon-search"></i> Historic Report', 'url'=>array('devicehistoric/reportHistoric')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
);
?>

<h1>Upload Changes From Barcodes</h1>

<?php echo $this->renderPartial('_uploadform', array('model'=>$model)); ?>