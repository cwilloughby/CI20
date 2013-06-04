<?php
/* @var $this CrtCaseController */
/* @var $model CrtCase */
/* @var $cases CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Court Cases';

$this->breadcrumbs=array(
	'Court Case'=>array('index'),
	$model->caseno,
);

$this->menu2=array(
	array('label'=>'Search Court Cases', 'url'=>array('admin')),
	array('label'=>'Create Court Case', 'url'=>array('create')),
	array('label'=>'View Court Case', 'url'=>array('view', 'id'=>$model->caseno)),
	array('label'=>'Update Court Case', 'url'=>array('update', 'id'=>$model->caseno)),
	array('label'=>'Delete Court Case', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->caseno),'confirm'=>'Are you sure you want to delete this case?')),
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
	'dataProvider'=>$cases->advancedSearch($model->caseno, 4),
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
