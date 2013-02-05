<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	$model->policyid=>array('view','id'=>$model->policyid),
	'Update',
);

$this->menu=array(
	array('label'=>'List HR Policies', 'url'=>array('index')),
	array('label'=>'Create HR Policy', 'url'=>array('createpolicy')),
	array('label'=>'View HR Policy', 'url'=>array('view', 'id'=>$model->policyid)),
	array('label'=>'Manage HR Policies', 'url'=>array('admin')),
);
?>

<h1>Update HrPolicy <?php echo $model->policyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>