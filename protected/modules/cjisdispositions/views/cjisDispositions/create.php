<?php
/* @var $this CjisDispositionsController */
/* @var $model CjisDispositions */

$this->breadcrumbs=array(
	'CJIS Dispositions'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'List CJIS Dispositions', 'url'=>array('index')),
	array('label'=>'Manage CJIS Dispositions', 'url'=>array('admin')),
);
?>

<h1>Create CJIS Disposition</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>