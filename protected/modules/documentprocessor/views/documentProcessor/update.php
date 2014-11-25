<?php
/* @var $this DocumentsProcessorController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->documentid=>array('view','id'=>$model->documentid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'View Documents', 'url'=>array('view', 'id'=>$model->documentid)),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);
?>

<h1>Update Documents <?php echo $model->documentid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>