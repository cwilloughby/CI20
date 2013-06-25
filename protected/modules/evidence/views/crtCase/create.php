<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Court Cases'=>array('admin'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Court Cases', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Court Case', 'url'=>array('create')),
);
?>

<h1>Create Court Case</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>