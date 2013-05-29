<?php
/* @var $this UserInfoController */
/* @var $model UserInfo */

$this->pageTitle = Yii::app()->name . ' - Create User';

$this->breadcrumbs=array(
	'User Management'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search Users', 'url'=>array('admin')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'List Users', 'url'=>array('index')),
);
?>

<h1>Create New User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'departments'=>$departments)); ?>