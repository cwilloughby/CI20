<?php
/* @var $this HrPolicyController */
/* @var $model HrSections */

$this->pageTitle = Yii::app()->name . ' - Update HR Section';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	$model->policyid=>array('view','id'=>$model->policyid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List HR Policies', 'url'=>array('index')),
	array('label'=>'Manage HR Policies', 'url'=>array('admin')),
);
?>

<h1>Update HR Section <?php echo $model->policyid; ?></h1>

<?php echo $this->renderPartial('_formSection', array('model'=>$model)); ?>
