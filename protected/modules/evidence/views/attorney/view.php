<?php
/* @var $this AttorneyController */
/* @var $model Attorney */

$this->breadcrumbs=array(
	'Attorneys'=>array('index'),
	$model->attyid,
);

$this->menu=array(
	array('label'=>'List Attorney', 'url'=>array('index')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
	array('label'=>'Update Attorney', 'url'=>array('update', 'id'=>$model->attyid)),
	array('label'=>'Delete Attorney', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->attyid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attorney', 'url'=>array('admin')),
);
?>

<h1>View Attorney #<?php echo $model->attyid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'attyid',
		'lname',
		'fname',
		'type',
		'barid',
	),
)); ?>
