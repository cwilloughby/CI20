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
	array('label'=>'<i class="icon icon-search"></i> Search CJIS Issues', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create CJIS Issue', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List CJIS Issues', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View CJIS Issue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<i class="icon icon-edit"></i> Update CJIS Issue', 'url'=>array('update', 'id'=>$model->id), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list"></i> Change Priority Order', 'url'=>array('changepriorities'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>Update CJIS Issue <?php echo $model->key; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>