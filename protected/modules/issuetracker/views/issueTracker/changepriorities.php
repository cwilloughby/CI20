<?php
/* @var $this IssueTrackerController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Issue Tracker';

$this->breadcrumbs=array(
	'Issue Tracker'=>array('index'),
	'Change Priorities',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search CJIS Issues', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create CJIS Issue', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List CJIS Issues', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-list"></i> Change Priority Order', 'url'=>array('changepriorities'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>Change Priority Order</h1>

To increase the priority of an item, click and drag it upwards. To decrease the priority of an item, click and drag it downwards.

<div class="form">

<?php
echo CHtml::beginForm('printchecked');

// Organize the dataProvider data into a Zii-friendly array
$priority = CHtml::listData($dataProvider->getData(), 'id', 'priority');
$key = CHtml::listData($dataProvider->getData(), 'id', 'key');
$summary = CHtml::listData($dataProvider->getData(), 'id', 'summary');
$desc = CHtml::listData($dataProvider->getData(), 'id', 'description');

echo "<h4>" . CHtml::linkButton('Print Selected');
echo CHtml::link('Refreash Priority', '/issuetracker/issuetracker/changepriorities', array('style'=>'float:right;')) . "</h4>";
	
foreach($summary as $id=>$content)
{
     $sortableItems[$id] = 
		'<div class="portlet-decoration grabby"><div class="portlet-title">' . CHtml::checkBox($key[$id], false) . ' <b>Priority: ' . $priority[$id] . ', Key: ' . $key[$id] . ', Summary: ' . $content . '</b></div></div>'
		. '<div class="portlet-content grabby solid-back">' . $desc[$id] . '</div>';
}

// Implement the JUI Sortable plugin
$this->widget('zii.widgets.jui.CJuiSortable', array(
	'id' => 'priorityList',
	'items' => $sortableItems,
	'htmlOptions' => array('class' => 'priOrder'),
	'options' => array(
		'update'=>'js:function(event,ui){
			$.post("",{ChangePriorities:jQuery("ul#priorityList").sortable("toArray").toString()},function(data){});
		}'
	),
));

echo "<h4>" . CHtml::linkButton('Print Selected');
echo CHtml::link('Refreash Priority', '/issuetracker/issuetracker/changepriorities', array('style'=>'float:right;')) . "</h4>";
?>

<?php echo CHtml::endForm(); ?>