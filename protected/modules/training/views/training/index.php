<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = Yii::app()->name . ' - List Training Videos';

$this->breadcrumbs=array(
	'Training',
);

$this->menu2=array(
	array('label'=>'List Training Videos', 'url'=>array('index')),
);
?>

<h1>Training Resources</h1>
<br/>
<h3>Videos</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
