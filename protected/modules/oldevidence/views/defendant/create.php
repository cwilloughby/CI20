<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Defendants'=>array('admin'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Defendants', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Defendant', 'url'=>array('create')),
);
?>

<h1>Create Defendant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>