<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $case CrtCase */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Search Case Files'=>array('admin'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Change Court Case',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-zoom-in"></i> View Case File', 'url'=>array('/evidence/casesummary/view', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Case File', 'url'=>array('/evidence/casesummary/update', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-user"></i> Update Defendant', 'url'=>array('/evidence/defendant/changeDefendant', 'id'=>$summary->summaryid)),
);
?>

<h1>Change Court Case</h1>

<?php echo $this->renderPartial('_changeCourtCaseForm', array('case'=>$case)); ?>
