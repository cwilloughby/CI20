<?php
/* @var $this EvidenceController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - Evidence';

$this->breadcrumbs=array(
	'Evidence',
);

$this->menu2=array(
	array('label'=>'Search Evidence', 'url'=>array('admin')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
);
?>

<h1>Evidence</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
