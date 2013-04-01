<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Defendant'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'List Defendants', 'url'=>array('index')),
	array('label'=>'Manage Defendants', 'url'=>array('admin')),
);
?>

<h1>Create Defendant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>