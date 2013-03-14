<?php
/* @var $this EvidenceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Evidences',
);

$this->menu=array(
	array('label'=>'Create Evidence', 'url'=>array('create')),
	array('label'=>'Manage Evidence', 'url'=>array('admin')),
);
?>

<h1>Evidences</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
