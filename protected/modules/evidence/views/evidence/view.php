<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->breadcrumbs=array(
	'Evidence'=>array('index'),
	$model->evidenceid,
);

$this->menu=array(
	array('label'=>'List Evidence', 'url'=>array('index')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
	array('label'=>'Update Evidence', 'url'=>array('update', 'id'=>$model->evidenceid)),
	array('label'=>'Delete Evidence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->evidenceid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Evidence', 'url'=>array('admin')),
);
?>

<h1>View Evidence #<?php echo $model->evidenceid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'evidenceid',
		'caseno',
		'exhibitno',
		'evidencename',
		'comment',
		'dateadded',
		'exhibitlist',
	),
)); ?>
