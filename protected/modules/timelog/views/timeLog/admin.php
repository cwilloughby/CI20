<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$this->breadcrumbs=array(
	'Time Logs'=>array('index'),
	'Manage',
);

$this->menu2=array(
	array('label'=>'List Time Logs', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('time-log-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Time Logs</h1>

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

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'time-log-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
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
			'template'=>'{view}',
		),
	),
)); ?>
