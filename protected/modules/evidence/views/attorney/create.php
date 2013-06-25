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
	array('label'=>'<i class="icon icon-search"></i> Search Attorneys', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-user"></i> Create Attorney', 'url'=>array('create')),
);
?>

<h1>Create Attorney</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>