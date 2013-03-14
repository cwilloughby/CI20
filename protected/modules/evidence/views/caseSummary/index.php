<?php
/* @var $this CaseSummaryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cases',
);

$this->menu=array(
	array('label'=>'Create Case', 'url'=>array('create')),
	array('label'=>'Manage Cases', 'url'=>array('admin')),
);
?>

<h1>Cases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
