<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Case Summaries'=>array('index'),
	$model->summaryid,
);

$this->menu=array(
	array('label'=>'List CaseSummary', 'url'=>array('index')),
	array('label'=>'Create CaseSummary', 'url'=>array('create')),
	array('label'=>'Update CaseSummary', 'url'=>array('update', 'id'=>$model->summaryid)),
	array('label'=>'Delete CaseSummary', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->summaryid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CaseSummary', 'url'=>array('admin')),
);
?>

<h1>View CaseSummary #<?php echo $model->summaryid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'summaryid',
		'defid',
		'caseno',
		'location',
		'dispodate',
		'hearingdate',
		'hearingtype',
		'page',
		'sentence',
		'indate',
		'outdate',
		'destructiondate',
		'recip',
		'comment',
		'dna',
		'bio',
		'drug',
		'firearm',
		'money',
		'other',
	),
)); ?>
