<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->breadcrumbs=array(
	'Evidence'=>array('index'),
	$model->evidenceid,
);

$this->menu=array(
	array('label'=>'List Evidence', 'url'=>array('index')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
	array('label'=>'Update Evidence', 'url'=>array('update', 'id'=>$model->evidenceid)),
	array('label'=>'Delete Evidence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->evidenceid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Evidence', 'url'=>array('admin')),
);
?>

<h1>View Evidence #<?php echo $model->evidenceid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'caseno',
		'exhibitno',
		'evidencename',
		'comment',
		'dateadded',
		'exhibitlist',
	),
));

echo "<br/><b>" . CHtml::encode('Case Files') . "</b>";
// Output a list of all the cases that this defendant has been in with hyperlinks to each case's summary page.
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'case-summary-grid',
	'dataProvider'=>$cases->evidenceSearch($model->caseno),
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
		'caseno',
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
