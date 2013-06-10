<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->pageTitle = Yii::app()->name . ' - Issue Tracker';

$this->breadcrumbs=array(
	'Issue Tracker'=>array('index'),
	$model->key=>array('view','id'=>$model->key),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search CJIS Issues', 'url'=>array('admin')),
	array('label'=>'Create CJIS Issue', 'url'=>array('create')),
	array('label'=>'List CJIS Issues', 'url'=>array('index')),
	array('label'=>'View CJIS Issue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Update CJIS Issue', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Change Priority Order', 'url'=>array('changepriorities')),
);
?>

<h1>Update CJIS Issue <?php echo $model->key; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>