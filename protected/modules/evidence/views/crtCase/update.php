<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Court Cases'=>array('admin'),
	$model->caseno=>array('view','id'=>$model->caseno),
	'Update',
);

$this->menu2=array(
	array('label'=>'Search Court Cases', 'url'=>array('admin')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
	array('label'=>'View Court Case', 'url'=>array('view', 'id'=>$model->caseno)),
	array('label'=>'Update Court Case', 'url'=>array('update', 'id'=>$model->caseno)),
);
?>

<h1>Update Court Case <?php echo $model->caseno; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>