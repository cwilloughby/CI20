<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->pageTitle = Yii::app()->name . ' - View HR Policy';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	$model->policyid,
);

$this->menu2=array(
	array('label'=>'Search HR Policies', 'url'=>array('admin')),
	array('label'=>'Create HR Policy', 'url'=>array('createpolicy')),
	array('label'=>'List HR Policies', 'url'=>array('index')),
	array('label'=>'Update HR Policy', 'url'=>array('updatePolicy', 'id'=>$model->policyid)),
	array('label'=>'Delete HR Policy', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->policyid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View HR Policy #<?php echo $model->policyid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'policyid',
		'policy',
	),
)); ?>
