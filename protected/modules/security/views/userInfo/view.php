<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->pageTitle = Yii::app()->name . ' - View User';

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	$model->userid,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->userid)),
	($model->active == 2 
		? array('label'=>'Enable User', 'url'=>'#', 
			'linkOptions'=>array('submit'=>array('enable','id'=>$model->userid),'confirm'=>'Are you sure you want to enable this user?'))
		: array('label'=>'Disable User', 'url'=>'#', 
			'linkOptions'=>(array('submit'=>array('disable','id'=>$model->userid),'confirm'=>'Are you sure you want to disable this user?')))),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->userid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'userid',
		'firstname',
		'lastname',
		'middlename',
		'username',
		'email',
		'phoneext',
		array( 
			'name'=>'department_search', 
			'value'=>$model->department->departmentname 
		),
		'hiredate',
		'active',
	),
)); ?>
