<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->breadcrumbs=array(
	'Issue Trackers'=>array('index'),
	$model->key=>array('view','id'=>$model->key),
	'Update',
);

$this->menu=array(
	array('label'=>'List IssueTracker', 'url'=>array('index')),
	array('label'=>'Create IssueTracker', 'url'=>array('create')),
	array('label'=>'View IssueTracker', 'url'=>array('view', 'id'=>$model->key)),
	array('label'=>'Manage IssueTracker', 'url'=>array('admin')),
);
?>

<h1>Update IssueTracker <?php echo $model->key; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>