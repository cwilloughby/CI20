<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Defendant'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search Defendants', 'url'=>array('admin')),
);
?>

<h1>Create Defendant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>