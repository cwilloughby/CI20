<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->breadcrumbs=array(
	'Attorneys'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Attorney', 'url'=>array('index')),
	array('label'=>'Manage Attorney', 'url'=>array('admin')),
);
?>

<h1>Create Attorney</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>