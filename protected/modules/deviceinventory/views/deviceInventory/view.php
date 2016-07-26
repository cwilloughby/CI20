<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */
/* @var $current DeviceCurrent */
/* @var $historic DeviceHistoric */

$this->pageTitle = Yii::app()->name . ' - View Inventory Item';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	$model->deviceid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Inventory Report', 'url'=>array('reportInventory')),
	array('label'=>'<i class="icon icon-search"></i> Assignment Report', 'url'=>array('reportAssignments')),
	array('label'=>'<i class="icon icon-search"></i> Historic Report', 'url'=>array('devicehistoric/reportHistoric')),
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
		'model',
		'serial',
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
		array(
			'label'=>'URL',
			'type'=>'raw',
			'value'=>CHtml::link(CHtml::encode($model->url), $model->url)
		),
		'equipmenttype',
		array
		(
			'name' => 'enabled',
			'value' => ($model->enabled == 0) ? "No" : "Yes",
			'filter' => array(0 => 'No', '1' => 'Yes'),
		),
		array(        
			'name'=>'indate',
			'value'=>isset($model->indate)?CHtml::encode(date(' m/d/Y', strtotime($model->indate))):"N\\A"
		),
		array(        
			'name'=>'outdate',
			'value'=>isset($model->outdate)?CHtml::encode(date(' m/d/Y', strtotime($model->outdate))):"N\\A"
		),
	),
)); 
?>

<h3>Current Location</h3>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$current,
	'attributes'=>array(
		'username',
		'location',
		array(        
			'name'=>'datechanged',
			'value'=>isset($current->datechanged)?CHtml::encode(date(' m/d/Y', strtotime($current->datechanged))):"N\\A"
		),
	),
));
?>

<h3>Historic Locations</h3>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('CustomGridView', array(
	'id'=>'device-historic-grid',
	'dataProvider'=>$historic->search(),
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'username',
		'location',
		'datechanged',
	),
)); ?>
