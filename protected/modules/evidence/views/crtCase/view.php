<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->breadcrumbs=array(
	'Court Case'=>array('index'),
	$model->caseno,
);

$this->menu=array(
	array('label'=>'List Court Cases', 'url'=>array('index')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
	array('label'=>'Update Court Case', 'url'=>array('update', 'id'=>$model->caseno)),
	array('label'=>'Delete Court Case', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->caseno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Court Cases', 'url'=>array('admin')),
);
?>

<h1>View Court Case #<?php echo $model->caseno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'caseno',
		'crtdiv',
		'cptno',
	),
)); ?>
