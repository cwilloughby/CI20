<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->pageTitle = Yii::app()->name . ' - Attorneys';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Attorneys'=>array('admin'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search Attorneys', 'url'=>array('admin')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
);
?>

<h1>Create Attorney</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>