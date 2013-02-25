<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->pageTitle = Yii::app()->name . ' - Update Policy';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	$model->policyid=>array('view','id'=>$model->policyid),
	'Update',
);

$this->menu=array(
	array('label'=>'List HR Policies', 'url'=>array('index')),
	array('label'=>'Manage HR Policies', 'url'=>array('admin')),
);
?>

<h1>Update HR Policy <?php echo $model->policyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>