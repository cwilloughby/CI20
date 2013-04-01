<?php
/* @var $this HrPolicyController */
/* @var $model HrSection */

$this->pageTitle = Yii::app()->name . ' - Create HR Section';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'List HR Policies', 'url'=>array('index')),
	array('label'=>'Manage HR Policies', 'url'=>array('admin')),
);
?>

<h1>Create HR Section</h1>

<?php echo $this->renderPartial('_formSection', array('model'=>$model)); ?>
