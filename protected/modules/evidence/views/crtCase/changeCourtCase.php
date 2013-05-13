<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $case CrtCase */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Change Court Case',
);

$this->menu2=array(
	array('label'=>'View Case File', 'url'=>array('view', 'id'=>$summary->summaryid)),
	array('label'=>'Update Case File', 'url'=>array('update', 'id'=>$summary->summaryid)),
);
?>

<h1>Change Court Case</h1>

<?php echo $this->renderPartial('_changeCourtCaseForm', array('case'=>$case)); ?>
