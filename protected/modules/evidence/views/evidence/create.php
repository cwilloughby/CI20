<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->pageTitle = Yii::app()->name . ' - Evidence';

$this->breadcrumbs=array(
	'Evidence'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Evidence', 'url'=>array('index')),
	array('label'=>'Manage Evidence', 'url'=>array('admin')),
);
?>

<h1>Create Evidence</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>