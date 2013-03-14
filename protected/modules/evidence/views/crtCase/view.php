<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->breadcrumbs=array(
	'Crt Cases'=>array('index'),
	$model->caseno,
);

$this->menu=array(
	array('label'=>'List CrtCase', 'url'=>array('index')),
	array('label'=>'Create CrtCase', 'url'=>array('create')),
	array('label'=>'Update CrtCase', 'url'=>array('update', 'id'=>$model->caseno)),
	array('label'=>'Delete CrtCase', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->caseno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CrtCase', 'url'=>array('admin')),
);
?>

<h1>View CrtCase #<?php echo $model->caseno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'caseno',
		'crtdiv',
		'cptno',
	),
)); ?>
