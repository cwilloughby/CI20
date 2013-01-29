<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->breadcrumbs=array(
	'Hr Policies'=>array('index'),
	$model->sectionid,
);

$this->menu=array(
	array('label'=>'Show  HR Policy', 'url'=>array('index')),
	array('label'=>'Create HR Section', 'url'=>array('create')),
	array('label'=>'Update HR Section', 'url'=>array('update', 'id'=>$model->sectionid)),
	array('label'=>'Delete HR Section', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sectionid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HR Policy', 'url'=>array('admin')),
);
?>

<h1>View HR Section #<?php echo $model->sectionid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sectionid',
		'section',
	),
)); ?>
