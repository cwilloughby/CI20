<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - Upload CJIS File';

$this->breadcrumbs=array(
	'Search CJIS Files'=>array('searchableFileTable'),
	'Create',
);

$this->menu2=array(
	array('label'=>'Search CJIS Files', 'url'=>array('searchableFileTable')),
	array('label'=>'Upload CJIS File', 'url'=>array('createFileRecord'), 'visible'=>Yii::app()->user->checkAccess("IT")),
);
?>

<h1>Upload CJIS File</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>