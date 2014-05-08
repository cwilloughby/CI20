<?php
/* @var $this DocTableController */
/* @var $model DocTable */

$this->pageTitle = Yii::app()->name . ' - Post CJIS News';

$this->breadcrumbs=array(
	'News'=>array('index'),
	'CJIS News Post',
);

$this->menu2=array(
	array('label'=>'Search Documents', 'url'=>array('searchableFileTable')),
	array('label'=>'Create Document', 'url'=>array('createFileRecord'), 'visible'=>Yii::app()->user->checkAccess("IT")),
	array('label'=>'Update Document', 'url'=>array('updateFileRecord', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess("IT")),
	array('label'=>'Delete Document', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteFileRecord','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'visible'=>Yii::app()->user->checkAccess("IT")),
);
?>

<h1>Post CJIS News</h1>

<?php echo $this->renderPartial('_formCjisNews', array('model'=>$model)); ?>