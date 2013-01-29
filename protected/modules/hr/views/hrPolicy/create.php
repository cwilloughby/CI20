<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->breadcrumbs=array(
	'Hr Policies'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Show  HR Policy', 'url'=>array('index')),
	array('label'=>'Manage HR Policy', 'url'=>array('admin')),
);
?>

<h1>Create HrPolicy</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>