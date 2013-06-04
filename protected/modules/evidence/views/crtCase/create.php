<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Court Case'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search Court Cases', 'url'=>array('admin')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
);
?>

<h1>Create Court Case</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>