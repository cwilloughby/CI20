<?php
/* @var $this UserInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'User Management',
);

$this->menu=array(
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Manage Users', 'url'=>array('admin')),
);
?>

<h1>User List</h1>

<?php $this->widget('zii.widgets.CListView', array(
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
