<?php
/* @var $this HrSectionsController */
/* @var $model HrSections */

$this->breadcrumbs=array(
	'Hr Sections'=>array('index'),
	$model->sectionid,
);

$this->menu=array(
	array('label'=>'List HrSections', 'url'=>array('index')),
	array('label'=>'Create HrSections', 'url'=>array('create')),
	array('label'=>'Update HrSections', 'url'=>array('update', 'id'=>$model->sectionid)),
	array('label'=>'Delete HrSections', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sectionid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage HrSections', 'url'=>array('admin')),
);
?>

<h1>View HrSections #<?php echo $model->sectionid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sectionid',
		'section',
		'datemade',
	),
)); ?>
