<?php
/* @var $this EvaluationsController */
/* @var $model Evaluations */
/* @var $answersDataProvider DataProvider */

$this->pageTitle = Yii::app()->name . ' - View Evaluation';

$this->breadcrumbs=array(
	'Evaluation'=>array('index'),
	$model->evaluationid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Evaluations', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create Evaluation', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List Evaluations', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Evaluation', 'url'=>array('view', 'id'=>$model->evaluationid)),
	array('label'=>'<i class="icon icon-edit"></i> Fill Out Evaluation', 'url'=>array('answerquestions', 'id'=>$model->evaluationid, 'EvaluationAnswers_page'=>1), 'visible' => Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-user"></i> Change Employee', 'url'=>array('changeemployee', 'id'=>$model->evaluationid)),
);
?>

<h1>Evaluation #<?php echo $model->evaluationid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(        
			'name'=>'evaluationdate',
			'value'=>isset($model->evaluationdate)?CHtml::encode(date('g:i a m/d/Y', strtotime($model->evaluationdate))):"N\\A"
		),
		array(        
			'name'=>'employee',
			'value'=>isset($model->employee0)?CHtml::encode(
					$model->employee0->firstname . ' ' . $model->employee0->lastname):"Unknown"
		),
		array(
			'name'=>'evaluator',
			'value'=>isset($model->evaluator0)?CHtml::encode(
					$model->evaluator0->firstname . ' ' . $model->evaluator0->lastname):"Unknown"
		),
	),
));
?>
<br/>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".flash-success").animate({opacity: 1.0}, 1000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>

<?php
$this->widget('CustomListView', array(
	'dataProvider'=>$answersDataProvider,
	'itemView'=>'_editAnswers',
)); ?>

<?php echo $this->renderPartial('_instructions'); ?>