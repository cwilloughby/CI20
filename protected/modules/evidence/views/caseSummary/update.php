<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Case Summaries'=>array('index'),
	$model->summaryid=>array('view','id'=>$model->summaryid),
	'Update',
);

$this->menu=array(
	array('label'=>'List CaseSummary', 'url'=>array('index')),
	array('label'=>'Create CaseSummary', 'url'=>array('create')),
	array('label'=>'View CaseSummary', 'url'=>array('view', 'id'=>$model->summaryid)),
	array('label'=>'Manage CaseSummary', 'url'=>array('admin')),
);
?>

<h1>Update CaseSummary <?php echo $model->summaryid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>