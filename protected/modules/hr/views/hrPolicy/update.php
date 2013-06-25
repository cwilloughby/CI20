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
	array('label'=>'<i class="icon icon-search"></i> Search HR Policies', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create HR Policy', 'url'=>array('createpolicy')),
	array('label'=>'<i class="icon icon-list-alt"></i> List HR Policies', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-edit"></i> Update HR Policy', 'url'=>array('updatePolicy', 'id'=>$model->policyid)),
);
?>

<h1>Update HR Policy <?php echo $model->policyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>