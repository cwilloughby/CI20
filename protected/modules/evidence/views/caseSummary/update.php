<?php
/* @var $this CaseSummaryController */
/* @var $summary CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Search Case Files'=>array('admin'),
	$summary->summaryid=>array('view','id'=>$summary->summaryid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Case Files', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Case File', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Case File', 'url'=>array('view', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Case File', 'url'=>array('update', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-user"></i> Update Defendant', 'url'=>array('/evidence/defendant/changeDefendant', 'id'=>$summary->summaryid)),
	array('label'=>'<i class="icon icon-folder-open"></i> Update Court Case', 'url'=>array('/evidence/crtcase/changeCourtCase', 'id'=>$summary->summaryid)),
);
?>

<h1>Update Case File</h1>

<?php echo $this->renderPartial('_updateForm', array('summary'=>$summary)); ?>