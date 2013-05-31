<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->breadcrumbs=array(
	'Issue Trackers'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List IssueTracker', 'url'=>array('index')),
	array('label'=>'Manage IssueTracker', 'url'=>array('admin')),
);
?>

<h1>Create IssueTracker</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>