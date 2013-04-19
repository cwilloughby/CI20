<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $attorney Attorney */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Add Attorneys',
);

$this->menu2=array(
	array('label'=>'View Case File', 'url'=>array('view', 'id'=>$summary->summaryid)),
	array('label'=>'Update Case File', 'url'=>array('update', 'id'=>$summary->summaryid)),
);
?>

<?php echo $this->renderPartial('_changeAttorneyForm', array('summary'=>$summary, 'attorney'=>$attorney)); ?>
