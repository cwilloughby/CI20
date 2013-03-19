<?php
/* @var $this CaseSummaryController */
/* @var $case CaseSummary */
/* @var $evidence Evidence */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	$case->caseno,
);

$this->menu=array(
	array('label'=>'List Case Files', 'url'=>array('index')),
	array('label'=>'Create Case File', 'url'=>array('create')),
	array('label'=>'Update Case File', 'url'=>array('update', 'id'=>$case->summaryid)),
	array('label'=>'Delete Case File', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$case->summaryid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Case Files', 'url'=>array('admin')),
);
?>

<h1>View Case File <?php echo $case->caseno; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$case,
	'attributes'=>array(
		array(        
			'name'=>'defid',
			'value'=>isset($case->def)?CHtml::encode($case->def->fname . ' ' . $case->def->lname):"Unknown"
		),
		array(        
			'name'=>'div_search',
			'value'=>isset($case->def)?CHtml::encode($case->caseno0->crtdiv):"N/A"
		),
		array(        
			'name'=>'complaint_search',
			'value'=>isset($case->def)?CHtml::encode($case->caseno0->cptno):"N/A"
		),
		'location',
		array(
			'name' => 'dispodate',
			'value' => (isset($case->dispodate) && ((int)$case->dispodate))
				?CHtml::encode(date("m/d/Y", strtotime($case->dispodate))):"N/A",
		),
		array(
			'name' => 'hearingdate',
			'value' => (isset($case->hearingdate) && ((int)$case->hearingdate))
				?CHtml::encode(date("m/d/Y", strtotime($case->hearingdate))):"N/A",
		),
		'hearingtype',
		'page',
		'sentence',
		array(
			'name' => 'indate',
			'value' => (isset($case->indate) && ((int)$case->indate))
				?CHtml::encode(date("m/d/Y", strtotime($case->indate))):"N/A",
		),
		array(
			'name' => 'outdate',
			'value' => (isset($case->outdate) && ((int)$case->outdate))
				?CHtml::encode(date("m/d/Y", strtotime($case->outdate))):"N/A",
		),
		array(
			'name' => 'destructiondate',
			'value' => (isset($case->destructiondate) && ((int)$case->destructiondate))
				?CHtml::encode(date("m/d/Y", strtotime($case->destructiondate))):"N/A",
		),
		'recip',
		'comment',
		array(        
			'name'=>'dna',
			'value'=>($case->dna == 0)?"No":(($case->dna == 1)?"Yes":"N/A"),
		),
		array(        
			'name'=>'bio',
			'value'=>($case->bio == 0)?"No":(($case->bio == 1)?"Yes":"N/A"),
		),
		array(        
			'name'=>'drug',
			'value'=>($case->drug == 0)?"No":(($case->drug == 1)?"Yes":"N/A"),
		),
		array(        
			'name'=>'firearm',
			'value'=>($case->firearm == 0)?"No":(($case->firearm == 1)?"Yes":"N/A"),
		),
		array(        
			'name'=>'money',
			'value'=>($case->money == 0)?"No":(($case->money == 1)?"Yes":"N/A"),
		),
		array(        
			'name'=>'other',
			'value'=>($case->other == 0)?"No":(($case->other == 1)?"Yes":"N/A"),
		),
	),
));

echo "<br/><h3>Attorneys</h3>";

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'attorney-grid',
	'dataProvider'=>$attorneys->search($case->summaryid),
	'filter'=>$attorneys,
	'columns'=>array(
		'fname',
		'lname',
		'type',
		'barid',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
		),
	),
));

echo "<br/><h3>Evidence</h3>";

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'evidence-grid',
	'dataProvider'=>$evidence->search($case->caseno),
	'filter'=>$evidence,
	'afterAjaxUpdate'=>"function(){jQuery('#date_added_search').datepicker({
		'dateFormat': 'yy-mm-dd',
		'showAnim':'fold',
		'changeYear':true,
		'changeMonth':true,
		'showButtonPanel':true})}",
	'columns'=>array(
		'exhibitlist',
		'caseno',
		'exhibitno',
		'evidencename',
		'comment',
		array(
			'name' => 'dateadded',
			'value' => '(isset($data->dateadded) && ((int)$data->dateadded))
				?CHtml::encode(date("m/d/Y", strtotime($data->dateadded))):"N/A"',
			'type' => 'raw', 
			'filter'=>$this->widget('zii.widgets.jui.CJuiDatepicker', array(
				'model'=>$evidence, 
				'attribute'=>'dateadded', 
				'htmlOptions' => array('id' => 'date_added_search'), 
				'options' => array(
					'showAnim' => 'fold',
					'dateFormat' => 'yy-mm-dd',
					'defaultDate' => $evidence->dateadded,
					'changeYear' => true,
					'changeMonth' => true,
					'showButtonPanel' => true,
				)
			), true)
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}',
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("/evidence/evidence/view", array("id"=>$data->evidenceid))'
				),
			),
		),
	),
)); ?>
