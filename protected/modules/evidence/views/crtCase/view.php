<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */

$this->breadcrumbs=array(
	'Court Case'=>array('index'),
	$model->caseno,
);

$this->menu=array(
	array('label'=>'List Court Cases', 'url'=>array('index')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
	array('label'=>'Update Court Case', 'url'=>array('update', 'id'=>$model->caseno)),
	array('label'=>'Delete Court Case', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->caseno),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Court Cases', 'url'=>array('admin')),
);
?>

<h1>View Court Case #<?php echo $model->caseno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'caseno',
		'crtdiv',
		'cptno',
	),
));

echo "<br/><b>" . CHtml::encode('Case Files') . "</b>";
// Output a list of all the cases that this defendant has been in with hyperlinks to each case's summary page.
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'case-summary-grid',
	'dataProvider'=>$cases->caseSearch($model->caseno),
	'filter'=>$cases,
	'columns'=>array(
		array( 
			'name'=>'def_search1', 
			'value'=>'$data->def->fname' 
		),
		array( 
			'name'=>'def_search2', 
			'value'=>'$data->def->lname' 
		),
		'hearingdate',
		'hearingtype',
		'sentence',
		'comment',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("/evidence/casesummary/view", array("id"=>$data->summaryid))'
				),
			),
		),
	),
)); ?>
