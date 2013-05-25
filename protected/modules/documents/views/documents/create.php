<?php
/* @var $this DocumentsController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Search Documents', 'url'=>array('admin')),
	array('label'=>'List Documents', 'url'=>array('index')),
);
?>

<h1>Create Documents</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>