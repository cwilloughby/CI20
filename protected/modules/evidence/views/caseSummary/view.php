<?php
/* @var $this CaseSummaryController */
/* @var $case CaseSummary */
/* @var $evidence Evidence */

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
		'dispodate',
		'hearingdate',
		'hearingtype',
		'page',
		'sentence',
		'indate',
		'outdate',
		'destructiondate',
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

$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'evidence-grid',
	'dataProvider'=>$evidence->search($case->caseno),
	'filter'=>$evidence,
	'columns'=>array(
		'exhibitlist',
		'caseno',
		'exhibitno',
		'evidencename',
		'comment',
		'dateadded',
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}',
		),
	),
)); ?>
