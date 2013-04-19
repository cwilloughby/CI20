<?php
/* @var $this DefendantController */
/* @var $model Defendant */
/* @var $cases CaseSummary */

$this->pageTitle = Yii::app()->name . ' - Defendants';

$this->breadcrumbs=array(
	'Defendant'=>array('index'),
	$model->defid,
);

$this->menu2=array(
	array('label'=>'List Defendants', 'url'=>array('index')),
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'Update Defendant', 'url'=>array('update', 'id'=>$model->defid)),
	array('label'=>'Delete Defendant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->defid),'confirm'=>'Are you sure you want to delete this defendant?')),
	array('label'=>'Manage Defendants', 'url'=>array('admin')),
);
?>

<h1>View Defendant <?php echo $model->fname . " " . $model->lname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fname',
		'lname',
		'oca',
	),
)); 

echo "<br/><b>" . CHtml::encode('Case Files') . "</b>";
// Output a list of all the cases that this defendant has been in with hyperlinks to each case's summary page.
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'case-summary-grid',
	'dataProvider'=>$cases->advancedSearch($model->defid, 3),
	'filter'=>$cases,
	'afterAjaxUpdate'=>"function(){jQuery('#hearing_date_search').datepicker({
		'dateFormat': 'yy-mm-dd',
		'showAnim':'fold',
		'changeYear':true,
		'changeMonth':true,
		'showButtonPanel':true})}",
	'columns'=>array(
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
