<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */

$this->pageTitle = Yii::app()->name . ' - View Inventory Item';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	$model->deviceid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Inventory', 'url'=>array('search')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Inventory Item', 'url'=>array('view', 'id'=>$model->deviceid)),
	array('label'=>'<i class="icon icon-edit"></i> Quick Item Update', 'url'=>array('quickupdate', 'id'=>$model->deviceid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Inventory Item', 'url'=>array('update', 'id'=>$model->deviceid)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Inventory Item', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->deviceid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Inventory Item #<?php echo $model->deviceid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'deviceid',
		'username',
		'extension',
		'model',
		'servicetag',
		'devicename',
		array(        
			'name'=>'warrentyenddate',
			'value'=>isset($model->warrentyenddate)?CHtml::encode(date(' m/d/Y', strtotime($model->warrentyenddate))):"N\\A"
		),
		array(        
			'name'=>'revolvedate',
			'value'=>isset($model->revolvedate)?CHtml::encode(date(' m/d/Y', strtotime($model->revolvedate))):"N\\A"
		),
		'comments',
		'location',
		'serial',
		'url',
		'equipmenttype',
		'enabled',
		array(        
			'name'=>'indate',
			'value'=>isset($model->indate)?CHtml::encode(date(' m/d/Y', strtotime($model->indate))):"N\\A"
		),
		array(        
			'name'=>'outdate',
			'value'=>isset($model->outdate)?CHtml::encode(date(' m/d/Y', strtotime($model->outdate))):"N\\A"
		),
	),
)); ?>
