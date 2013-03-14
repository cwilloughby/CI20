<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->breadcrumbs=array(
	'Attorneys'=>array('index'),
	$model->attyid=>array('view','id'=>$model->attyid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Attorney', 'url'=>array('index')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
	array('label'=>'View Attorney', 'url'=>array('view', 'id'=>$model->attyid)),
	array('label'=>'Manage Attorney', 'url'=>array('admin')),
);
?>

<h1>Update Attorney <?php echo $model->attyid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>