<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */

$this->pageTitle = Yii::app()->name . ' - Update Inventory Item';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	$model->deviceid=>array('view','id'=>$model->deviceid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Inventory', 'url'=>array('search')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Inventory Item', 'url'=>array('view', 'id'=>$model->deviceid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Inventory Item', 'url'=>array('update', 'id'=>$model->deviceid)),
);
?>

<h1>Update Inventory Item <?php echo $model->deviceid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>