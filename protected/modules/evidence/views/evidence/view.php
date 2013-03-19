<?php
/* @var $this EvidenceController */
/* @var $model Evidence */

$this->pageTitle = Yii::app()->name . ' - Evidence';

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

<h1>View Evidence <?php echo $model->exhibitno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'caseno',
		'exhibitno',
		'evidencename',
		'comment',
		array(
			'name' => 'dateadded',
			'value' => (isset($case->dateadded) && ((int)$case->dateadded))
				?CHtml::encode(date("m/d/Y", strtotime($case->dateadded))):"N/A",
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
		array(
			'name' => 'hearingdate',
			'value' => '(isset($data->hearingdate) && ((int)$data->hearingdate))
				?CHtml::encode(date("m/d/Y", strtotime($data->hearingdate))):"N/A"',
			'type' => 'raw', 
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
				'model'=>$cases, 
				'attribute'=>'hearingdate', 
				'htmlOptions' => array('id' => 'hearing_date_search'), 
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'defaultDate' => $cases->hearingdate,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				)
			), true)
		),
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
