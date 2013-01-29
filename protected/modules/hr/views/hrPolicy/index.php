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

<h1>HR Policy</h1>

<?php $this->widget('zii.widgets.Jui.CJuiAccordion', array(
	'panels'=>$panels,
)); ?>
