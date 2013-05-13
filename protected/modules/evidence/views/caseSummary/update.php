<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Update',
);

$this->menu2=array(
	array('label'=>'List Case Files', 'url'=>array('index')),
	array('label'=>'Create Case File', 'url'=>array('create')),
	array('label'=>'View Case File', 'url'=>array('view', 'id'=>$summary->summaryid)),
	array('label'=>'Manage Case Files', 'url'=>array('admin')),
);
?>

<h1>Update Case File</h1>

<?php echo $this->renderPartial('_updateForm', array('summary'=>$summary)); ?>