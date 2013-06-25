<?php
/* @var $this HrPolicyController */
/* @var $model HrSection */

$this->pageTitle = Yii::app()->name . ' - Create HR Section';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search HR Policies', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List HR Policies', 'url'=>array('index')),
);
?>

<h1>Create HR Section</h1>

<?php echo $this->renderPartial('_formSection', array('model'=>$model)); ?>
