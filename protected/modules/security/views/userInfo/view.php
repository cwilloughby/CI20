<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->pageTitle = Yii::app()->name . ' - View User';

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	$model->userid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Users', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create User', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Users', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View User', 'url'=>array('view', 'id'=>$model->userid)),
	array('label'=>'<i class="icon icon-edit"></i> Update User', 'url'=>array('update', 'id'=>$model->userid)),
	($model->active == 2 
		? array('label'=>'<i class="icon icon-ok"></i> Enable User', 'url'=>'#', 
			'linkOptions'=>array('submit'=>array('enable','id'=>$model->userid),'confirm'=>'Are you sure you want to enable this user?'))
		: array('label'=>'<i class="icon icon-remove"></i> Disable User', 'url'=>'#', 
			'linkOptions'=>(array('submit'=>array('disable','id'=>$model->userid),'confirm'=>'Are you sure you want to disable this user?')))),
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
		array(        
			'name'=>'hiredate',
			'value'=>isset($model->hiredate)?CHtml::encode(date('m/d/Y', strtotime($model->hiredate))):"N\\A"
		),
		array(        
			'name'=>'active',
			'value'=>($model->hiredate == 1)?"Yes":"No",
		),
	),
)); ?>
