<?php
/* @var $this GsTimeLogController */
/* @var $model GsTimeLog */

$this->pageTitle = Yii::app()->name . " - GS Time Log";

$this->breadcrumbs=array(
	'GS Time Logs'=>array('index'),
	'Search',
);

$this->menu2=array(
	array('label'=>'List GS Time Log', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gs-time-log-grid', {
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
    $.fn.yiiGridView.update('gs-time-log-grid',{
        success: function() {
            $('#gs-time-log-grid').removeClass('grid-view-loading');
            window.location = '". $this->createUrl('exportFile')  . "';
        },
        data: $('.search-form form').serialize() + '&export=true'
    });
}
");
?>

<h1>Search GS Time Logs</h1>

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

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gs-time-log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'afterAjaxUpdate'=>"function(){jQuery('#event_date_search').datepicker({'dateFormat': 'mm/dd/yy'})}",
	'columns'=>array(
		'username',
		'computername',
		array(
			'name' => 'eventdate',
			'value' => '(isset($data->eventdate) && ((int)$data->eventdate))
				?CHtml::encode(date("m/d/Y", strtotime($data->eventdate))):"N/A"',
			'type' => 'raw', 
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
				'model'=>$model,
				'attribute'=>'eventdate', 
				'htmlOptions' => array('id' => 'event_date_search'), 
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'mm/dd/yy',
					'defaultDate' => $model->eventdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				)
			), true)
		),
		'eventtype',
		array(
			'name' => 'eventtime',
			'value' => 'DATE("g:i:s a", STRTOTIME("$data->eventtime"))',
		),
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('gs-time-log-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}',
		),
	),
)); ?>
