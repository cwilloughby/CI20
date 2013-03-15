<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->breadcrumbs=array(
	'Attorney'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attorneys', 'url'=>array('index')),
	array('label'=>'Manage Attorneys', 'url'=>array('admin')),
);
?>

<h1>Create Attorney</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>