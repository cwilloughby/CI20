<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $defendant Defendant */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Search Case Files'=>array('admin'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Change Defendant',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-zoom-in"></i> View Case File', 'url'=>array('/evidence/casesummary/view', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Case File', 'url'=>array('/evidence/casesummary/update', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-folder-open"></i> Update Court Case', 'url'=>array('/evidence/crtcase/changeCourtCase', 'id'=>$summary->summaryid)),
);
?>

<h1>Change Defendant On Case File <?php echo $summary->caseno; ?></h1>

<?php echo $this->renderPartial('_changeDefendantForm', array('defendant'=>$defendant)); ?>
