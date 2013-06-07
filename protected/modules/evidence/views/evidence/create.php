<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->pageTitle = Yii::app()->name . ' - Evidence';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Evidence'=>array('admin'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search Evidence', 'url'=>array('admin')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
);
?>

<h1>Create Evidence</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>