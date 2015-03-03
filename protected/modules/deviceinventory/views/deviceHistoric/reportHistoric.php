<?php
/* @var $this DeviceInventoryController */
/* @var $model DeviceHistoric */

$this->pageTitle = Yii::app()->name . ' - Historic Report';

$this->breadcrumbs=array(
	'Device Inventory'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Inventory Report', 'url'=>array('deviceinventory/reportInventory')),
	array('label'=>'<i class="icon icon-search"></i> Assignment Report', 'url'=>array('deviceinventory/reportAssignments')),
	array('label'=>'<i class="icon icon-search"></i> Historic Report', 'url'=>array('devicehistoric/reportHistoric')),
	array('label'=>'<i class="icon icon-file"></i> Create Inventory Item', 'url'=>array('deviceinventory/create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Inventory', 'url'=>array('deviceinventory/index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('device-historic-grid', {
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
    $.fn.yiiGridView.update('device-historic-grid',{
        success: function() {
            $('#device-historic-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}
");
?>

<h1>Historic Locations</h1>

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
	'id'=>'device-historic-grid',
	'dataProvider'=>$model->search(),
	'filter'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id) ? $model : null),
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columns'=>array(
		array( 
			'name'=>'device_search',
			'value'=>'$data->device->devicename',
		),
		'username',
		'location',
		'datechanged',
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('device-historic-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'',
		),
	),
)); ?>