<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->breadcrumbs=array(
	'Crt Cases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CrtCase', 'url'=>array('index')),
	array('label'=>'Manage CrtCase', 'url'=>array('admin')),
);
?>

<h1>Create CrtCase</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>