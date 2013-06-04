<?php
/* @var $this AttorneyController */
/* @var $model Attorney */
/* @var $cases CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Attorneys';

$this->breadcrumbs=array(
	'Attorney'=>array('index'),
	$model->attyid,
);

$this->menu2=array(
	array('label'=>'Search Attorneys', 'url'=>array('admin')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
	array('label'=>'View Attorney', 'url'=>array('view', 'id'=>$model->attyid)),
	array('label'=>'Update Attorney', 'url'=>array('update', 'id'=>$model->attyid)),
	array('label'=>'Delete Attorney', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->attyid),'confirm'=>'Are you sure you want to delete this attorney?')),
);
?>

<h1>View Attorney <?php echo $model->fname . " " . $model->lname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fname',
		'lname',
		'type',
		'barid',
	),
)); 

echo "<br/><b>" . CHtml::encode('Case Files') . "</b>";
// Output a list of all the cases that the attorney has worked on.
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'case-summary-grid',
	'dataProvider'=>$cases->advancedSearch($model->attyid, 1),
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
