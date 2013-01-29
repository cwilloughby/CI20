<?php
/* @var $this HrPolicyController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hr Policies',
);

$this->menu=array(
	array('label'=>'Create HR Section', 'url'=>array('create')),
	array('label'=>'Manage HR Policy', 'url'=>array('admin')),
);
?>

<h1>Hr Policies</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
