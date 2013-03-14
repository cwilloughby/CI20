<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->breadcrumbs=array(
	'Defendants'=>array('index'),
	$model->defid=>array('view','id'=>$model->defid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Defendant', 'url'=>array('index')),
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'View Defendant', 'url'=>array('view', 'id'=>$model->defid)),
	array('label'=>'Manage Defendant', 'url'=>array('admin')),
);
?>

<h1>Update Defendant <?php echo $model->defid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>