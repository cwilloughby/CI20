<?php
/* @var $this DefendantController */
/* @var $model Defendant */

$this->breadcrumbs=array(
	'Defendants'=>array('index'),
	$model->defid,
);

$this->menu=array(
	array('label'=>'List Defendant', 'url'=>array('index')),
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'Update Defendant', 'url'=>array('update', 'id'=>$model->defid)),
	array('label'=>'Delete Defendant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->defid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Defendant', 'url'=>array('admin')),
);
?>

<h1>View Defendant #<?php echo $model->defid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'defid',
		'lname',
		'fname',
		'oca',
	),
)); ?>
