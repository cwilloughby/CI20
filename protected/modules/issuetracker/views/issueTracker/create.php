<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->pageTitle = Yii::app()->name . ' - Issue Tracker';

$this->breadcrumbs=array(
	'Issue Trackers'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search CJIS Issues', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create CJIS Issue', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List CJIS Issues', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-list"></i> Change Priority Order', 'url'=>array('changepriorities'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>Create CJIS Issue</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>