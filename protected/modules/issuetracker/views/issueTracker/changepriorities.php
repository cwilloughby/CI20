<?php
/* @var $this IssueTrackerController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Issue Tracker'=>array('index'),
	'Change Priorities',
);

$this->menu2=array(
	array('label'=>'Search CJIS Issues', 'url'=>array('admin')),
	array('label'=>'Create CJIS Issue', 'url'=>array('create')),
	array('label'=>'List CJIS Issues', 'url'=>array('index')),
	array('label'=>'Change Priority Order', 'url'=>array('changepriorities')),
);
?>

<h1>Change Priority Order</h1>

<?php
// Organize the dataProvider data into a Zii-friendly array
$items = CHtml::listData($dataProvider->getData(), 'id', 'summary');

// Implement the JUI Sortable plugin
$this->widget('zii.widgets.jui.CJuiSortable', array(
	'id' => 'priorityList',
	'items' => $items,
	'htmlOptions' => array('class' => 'priOrder'),
	'options' => array(
		'update'=>'js:function(event,ui){
			$.post("",{ChangePriorities:$("ul#priorityList").sortable("toArray").toString()},function(data){});
		}'
	),
));
?>
