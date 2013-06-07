<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->pageTitle = Yii::app()->name . ' - Issue Tracker';

$this->breadcrumbs=array(
	'Issue Trackers'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search CJIS Issues', 'url'=>array('admin')),
	array('label'=>'Create CJIS Issue', 'url'=>array('create')),
	array('label'=>'List CJIS Issues', 'url'=>array('index')),
	array('label'=>'Change Priority Order', 'url'=>array('changepriorities')),
);
?>

<h1>Create CJIS Issue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>