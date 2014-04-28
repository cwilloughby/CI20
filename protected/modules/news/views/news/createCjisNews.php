<?php
/* @var $this NewsController */
/* @var $model News */

$this->pageTitle = Yii::app()->name . ' - Post CJIS News';

$this->breadcrumbs=array(
	'News'=>array('index'),
	'CJIS News Post',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search News Posts', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create News Post', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List News Posts', 'url'=>array('index')),
);
?>

<h1>Post CJIS News</h1>

<?php echo $this->renderPartial('_formCjisNews', array('model'=>$model)); ?>