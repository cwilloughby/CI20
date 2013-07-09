<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	'Create',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search News Posts', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create News Post', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List News Posts', 'url'=>array('index')),
);
?>

<h1>Create News</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>