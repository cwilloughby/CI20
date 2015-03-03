<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceInventory */

$this->pageTitle = Yii::app()->name . ' - Search Inventory';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Inventory Report', 'url'=>array('reportInventory')),
	array('label'=>'<i class="icon icon-search"></i> Assignment Report', 'url'=>array('reportAssignments')),
	array('label'=>'<i class="icon icon-search"></i> Historic Report', 'url'=>array('devicehistoric/reportHistoric')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-file"></i> Upload Inventory Changes', 'url'=>array('importChangesViaBarcodes')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('device-inventory-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('export', "
$('#export-button').on('click',function() {
    $.fn.yiiGridView.export();
});
$.fn.yiiGridView.export = function() {
    $.fn.yiiGridView.update('device-inventory-grid',{
        success: function() {
            $('#device-inventory-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}
");
?>

<h1>Search Device Assignments</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<br/>

<?php echo CHtml::button('Export', array('id'=>'export-button','class'=>'button')); ?>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('CustomGridView', array(
	'id'=>'device-inventory-grid',
	'dataProvider'=>$model->search(),
	'filter'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id) ? $model : null),
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		'deviceid',
		'equipmenttype',
		'devicename',
		array
		(
			'name' => 'enabled',
			'value' => '($data->enabled == 0) ? "No" : "Yes"',
			'filter' => array(0 => 'No', '1' => 'Yes'),
		),
		array( 
			'name'=>'user_search',
			'value'=>'$data->deviceCurrent->username',
		),
		array( 
			'name'=>'location_search',
			'value'=>'$data->deviceCurrent->location',
		),
		'indate',
		'outdate',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('device-inventory-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}{update}',
			'buttons'=>  array
			(
				'update' => array
				(
					'url' => 'Yii::app()->createUrl("deviceinventory/deviceinventory/quickupdate", array("id"=>$data->deviceid))',
				)
			)
		),
	),
)); ?>
