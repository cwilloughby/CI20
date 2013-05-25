<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->pageTitle = Yii::app()->name . ' - Update User';

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	$model->userid=>array('view','id'=>$model->userid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Users', 'url'=>array('admin')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'View User', 'url'=>array('view', 'id'=>$model->userid)),
	($model->active == 2 
		? array('label'=>'Enable User', 'url'=>'#', 
			'linkOptions'=>array('submit'=>array('enable','id'=>$model->userid),'confirm'=>'Are you sure you want to enable this user?'))
		: array('label'=>'Disable User', 'url'=>'#', 
			'linkOptions'=>(array('submit'=>array('disable','id'=>$model->userid),'confirm'=>'Are you sure you want to disable this user?')))),
);
?>

<h1>Update User <?php echo $model->userid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'departments'=>$departments)); ?>