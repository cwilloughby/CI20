<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->pageTitle = Yii::app()->name . ' - Update Policy';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	$model->policyid=>array('view','id'=>$model->policyid),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search HR Policies', 'url'=>array('admin')),
	array('label'=>'Create HR Policy', 'url'=>array('createpolicy')),
	array('label'=>'List HR Policies', 'url'=>array('index')),
	array('label'=>'Update HR Policy', 'url'=>array('updatePolicy', 'id'=>$model->policyid)),
);
?>

<h1>Update HR Policy <?php echo $model->policyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>