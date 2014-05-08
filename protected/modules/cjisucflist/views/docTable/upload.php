<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - Upload CJIS File';

$this->breadcrumbs=array(
	'Search CJIS Files'=>array('searchableFileTable'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search Documents', 'url'=>array('searchableFileTable')),
	array('label'=>'Create Document', 'url'=>array('createFileRecord'), 'visible'=>Yii::app()->user->checkAccess("IT")),
);
?>

<h1>Create Document</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>