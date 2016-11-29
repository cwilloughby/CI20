<?php
/* @var $this TimeLogController */
/* @var $model TimeLog */

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);

$this->widget('CustomGridView', array(
	'id'=>'time-log-grid',
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
			'type' => 'raw', 
			'value' => 'DATE("g:i:s a", STRTOTIME("$data->eventtime"))',
		),
		array(
			'class'=>'CButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10,20=>20,30=>30),array(
				'onchange'=>"$.fn.yiiGridView.update('time-log-grid',{ data:{pageSize: $(this).val() }})",
			)),
			'template'=>'{view}',
		),
	),
)); ?>
