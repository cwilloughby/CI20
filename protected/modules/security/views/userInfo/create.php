<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('index')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>Create New User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'departments'=>$departments)); ?>