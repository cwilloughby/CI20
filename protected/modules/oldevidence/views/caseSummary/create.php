<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */
/* @var $defendant Defendant */
/* @var $case CrtCase */
/* @var $attorney Attorney */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Search Case Files'=>array('admin'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Case Files', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Case File', 'url'=>array('create')),
);
?>

<h1>Create Case File</h1>

<?php echo $this->renderPartial('_form', array(
	'summary' => $summary, 
	'defendant' => $defendant, 
	'case' => $case, 
	'attorney' => $attorney)); ?>