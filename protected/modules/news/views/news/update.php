<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->newsid=>array('view','id'=>$model->newsid),
	'Update',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search News Posts', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create News Post', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List News Posts', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View News Post', 'url'=>array('view', 'id'=>$model->newsid)),
	array('label'=>'<i class="icon icon-edit"></i> Update News Post', 'url'=>array('update', 'id'=>$model->newsid), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>Update News <?php echo $model->newsid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>