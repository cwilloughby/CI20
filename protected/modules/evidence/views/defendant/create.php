<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->breadcrumbs=array(
	'Defendants'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Defendant', 'url'=>array('index')),
	array('label'=>'Manage Defendant', 'url'=>array('admin')),
);
?>

<h1>Create Defendant</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>