<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->pageTitle = Yii::app()->name . ' - Create User';

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Users', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create User', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Users', 'url'=>array('index')),
);
?>

<h1>Create New User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'departments'=>$departments)); ?>