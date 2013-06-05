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
$priority = CHtml::listData($dataProvider->getData(), 'id', 'priority');
$key = CHtml::listData($dataProvider->getData(), 'id', 'key');
$summary = CHtml::listData($dataProvider->getData(), 'id', 'summary');
$desc = CHtml::listData($dataProvider->getData(), 'id', 'description');

foreach($summary as $id=>$content)
{
     $sortableItems[$id] = '<a class="tooltip" href="#" title="To increase the priority of this item, click and drag it upwards. To decrease the priority of this item, click and drag it downwards.">'
			. '<div class="portlet-decoration"><div class="portlet-title">' . $key[$id] . ' Summary: ' . $content . '</div></div>'
			. '<div class="portlet-content">' . $desc[$id] . '</div>'
			. '</a>';
}

// Implement the JUI Sortable plugin
$this->widget('zii.widgets.jui.CJuiSortable', array(
	'id' => 'priorityList',
	'items' => $sortableItems,
	'htmlOptions' => array('class' => 'priOrder'),
	'options' => array(
		'update'=>'js:function(event,ui){
			$.post("",{ChangePriorities:$("ul#priorityList").sortable("toArray").toString()},function(data){});
		}'
	),
));
?>