<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $attorney Attorney */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Search Case Files'=>array('admin'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Add Attorneys',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-zoom-in"></i> View Case File', 'url'=>array('view', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Case File', 'url'=>array('update', 'id'=>$summary->summaryid)),
);
?>

<?php echo $this->renderPartial('_changeAttorneyForm', array('summary'=>$summary, 'attorney'=>$attorney)); ?>
