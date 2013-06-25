<?php
/* @var $this EvaluationQuestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = Yii::app()->name . ' - List Evaluation Questions';

$this->breadcrumbs=array(
	'Evaluation Questions',
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Evaluation Questions', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create Evaluation Question', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Evaluation Questions', 'url'=>array('index')),
);
?>

<h1>Evaluation Questions</h1>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); ?>
