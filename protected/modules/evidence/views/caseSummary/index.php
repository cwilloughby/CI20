<?php
/* @var $this CaseSummaryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Case Summaries',
);

$this->menu=array(
	array('label'=>'Create CaseSummary', 'url'=>array('create')),
	array('label'=>'Manage CaseSummary', 'url'=>array('admin')),
);
?>

<h1>Case Summaries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
