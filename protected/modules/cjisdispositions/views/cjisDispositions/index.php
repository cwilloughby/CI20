<?php
/* @var $this CjisDispositionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'CJIS Dispositions',
);

$this->menu2=array(
	array('label'=>'Create CJIS Disposition', 'url'=>array('create')),
	array('label'=>'Manage CJIS Dispositions', 'url'=>array('admin')),
);
?>

<h1>CJIS Dispositions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
