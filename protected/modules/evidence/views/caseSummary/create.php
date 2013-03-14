<?php
/* @var $this CaseSummaryController */
/* @var $model CaseSummary */

$this->breadcrumbs=array(
	'Case Summaries'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CaseSummary', 'url'=>array('index')),
	array('label'=>'Manage CaseSummary', 'url'=>array('admin')),
);
?>

<h1>Create CaseSummary</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>