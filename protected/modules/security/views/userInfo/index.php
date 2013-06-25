<?php
/* @var $this UserInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - User List';

$this->breadcrumbs=array(
	'User Management',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Users', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create User', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Users', 'url'=>array('index')),
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
