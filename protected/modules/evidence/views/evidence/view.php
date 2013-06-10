<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->pageTitle = Yii::app()->name . ' - Evidence';

$this->breadcrumbs=array(
	'Advanced Tools'=>array('/evidence/casesummary/evidencemanager'),
	'Search Evidence'=>array('admin'),
	$model->evidenceid,
);

$this->menu2=array(
	array('label'=>'Search Evidence', 'url'=>array('admin')),
	array('label'=>'Create Evidence', 'url'=>array('create')),
	array('label'=>'View Evidence', 'url'=>array('view', 'id'=>$model->evidenceid)),
	array('label'=>'Update Evidence', 'url'=>array('update', 'id'=>$model->evidenceid)),
	array('label'=>'Delete Evidence', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->evidenceid),'confirm'=>'Are you sure you want to delete this piece of evidence?')),
);
?>

<h1>View Evidence</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'caseno',
		'exhibitno',
		'evidencename',
		'comment',
		'hearingtype',
		array(
			'name' => 'hearingdate',
			'value' => (isset($model->hearingdate) && ((int)$model->hearingdate))
				?CHtml::encode(date('m/d/Y', strtotime($model->hearingdate))):"N/A",
		),
		'exhibitlist',
	),
));

echo "<br/><b>" . CHtml::encode('Case Files') . "</b>";
// Output the case file that this specific piece of evidence is in.
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'case-summary-grid',
	'dataProvider'=>$cases->advancedSearch($model->caseno, 2),
	'filter'=>$cases,
	'afterAjaxUpdate'=>"function(){jQuery('#hearing_date_search').datepicker({
		'dateFormat': 'yy-mm-dd',
		'showAnim':'fold',
		'changeYear':true,
		'changeMonth':true,
		'showButtonPanel':true})}",
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
