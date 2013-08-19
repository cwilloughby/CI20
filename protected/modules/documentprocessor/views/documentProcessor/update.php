<?php
/* @var $this DocumentsController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->documentid=>array('view','id'=>$model->documentid),
	'Update',
);

$this->menu=array(
	array('label'=>'Search Documents', 'url'=>array('admin')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'View Documents', 'url'=>array('view', 'id'=>$model->documentid)),
	array('label'=>'Update Documents', 'url'=>array('update', 'id'=>$model->documentid)),
);
?>

<h1>Update Documents <?php echo $model->documentid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>