<?php
/* @var $this DocumentsProcessorController */
/* @var $model Documents */

$this->breadcrumbs=array(
	'Documents'=>array('index'),
	$model->documentid,
);

$this->menu=array(
	array('label'=>'List Documents', 'url'=>array('index')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'Update Documents', 'url'=>array('update', 'id'=>$model->documentid)),
	array('label'=>'Delete Documents', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->documentid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Documents', 'url'=>array('admin')),
);
?>

<h1>View Documents #<?php echo $model->documentid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'documentid',
		'uploader',
		'documentname',
		'path',
		'uploaddate',
		'type',
		'ext',
		'prefix',
		'description',
		'content',
		'modifiedby',
		'modifieddate',
		'signed',
		'disabled',
		'shareable',
	),
)); ?>
