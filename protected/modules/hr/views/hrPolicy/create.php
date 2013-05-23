<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->pageTitle = Yii::app()->name . ' - Create HR Policy';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search HR Policies', 'url'=>array('admin')),
	array('label'=>'List HR Policies', 'url'=>array('index')),
);
?>

<h1>Create HR Policy</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>