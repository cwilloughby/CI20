<?php
/* @var $this UserInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - User List';

$this->breadcrumbs=array(
	'User Management',
);

$this->menu2=array(
	array('label'=>'Search Users', 'url'=>array('admin')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'List Users', 'url'=>array('index')),
);
?>

<h1>User List</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'sortableAttributes'=>array(
		'firstname',
		'lastname',
		'username',
		'phoneext',
		'hiredate',
		'active',
	),
	'template'=>"{summary}\n{sorter}\n{pager}\n{items}\n{pager}"
)); ?>
