<?php
/* @var $this CaseSummaryController */
/* @var $case CaseSummary */
/* @var $evidence Evidence */

$this->pageTitle = Yii::app()->name . ' - Case Files';

$this->breadcrumbs=array(
	'Case File'=>array('index'),
	$case->caseno,
);

$this->menu2=array(
	array('label'=>'List Case Files', 'url'=>array('index')),
	array('label'=>'Create Case File', 'url'=>array('create')),
	array('label'=>'Update Case File', 'url'=>array('update', 'id'=>$case->summaryid)),
	array('label'=>'Update Defendant', 'url'=>array('/evidence/defendant/changeDefendant', 'id'=>$case->summaryid)),
	array('label'=>'Update Court Case', 'url'=>array('/evidence/crtcase/changeCourtCase', 'id'=>$case->summaryid)),
	array('label'=>'Delete Case File', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$case->summaryid),
		'confirm'=>'Are you sure you want to delete this case file?
This will NOT delete the defendant, case, attorneys, or evidence.')),
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
				?CHtml::encode(date('g:i a Y-m-d', strtotime($case->dispodate))):"N/A",
		),
		'page',
		'sentence',
		array(
			'name' => 'indate',
			'value' => (isset($case->indate) && ((int)$case->indate))
				?CHtml::encode(date('g:i a Y-m-d', strtotime($case->indate))):"N/A",
		),
		array(
			'name' => 'outdate',
			'value' => (isset($case->outdate) && ((int)$case->outdate))
				?CHtml::encode(date('g:i a Y-m-d', strtotime($case->outdate))):"N/A",
		),
		array(
			'name' => 'destructiondate',
			'value' => (isset($case->destructiondate) && ((int)$case->destructiondate))
				?CHtml::encode(date('g:i a Y-m-d', strtotime($case->destructiondate))):"N/A",
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
));?>

<br/><h3>Attorneys</h3>

<?php $this->widget('zii.widgets.grid.CGridView', array(
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
			'template'=>'{view}{delete}',
			'deleteConfirmation'=>"js:'Are you sure you want to remove this attorney from the case?'",
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("/evidence/attorney/view", array("id"=>$data->attyid))'
				),
				'delete'=>array(
					'label'=>'Remove Attorney',
					'url'=>'Yii::app()->createUrl("/evidence/casesummary/deleteAttorneyFromCase", 
						array("sid"=>' . $case->summaryid . ', "aid"=>$data->attyid))'
				),
			),
		),
	),
));

Yii::app()->clientScript->registerScript('addAttorney', "
$('.attorney-button').click(function(){
	$('.add-attorneys').toggle();
	return false;
});");

echo CHtml::link('Add Attorneys','#',array('class'=>'attorney-button')); ?>
<div class="add-attorneys" style="display:none">
<?php $this->renderPartial('../attorney/_changeAttorneyForm',array(
	'attorney' => $attorneys, 'summary' => $case
)); ?>
</div><!-- changeAttorneyForm -->

<br/><br/>
<hr>

<?php echo "<br/><h3>Evidence</h3>"; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
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
		'exhibitno',
		'evidencename',
		'comment',
		'hearingtype',
		array(
			'name' => 'hearingdate',
			'value' => '(isset($data->hearingdate) && ((int)$data->hearingdate))
				?CHtml::encode(date("m/d/Y", strtotime($data->hearingdate))):"N/A"',
		),
		array(
			'class'=>'CButtonColumn',
			'template'=>'{view}{update}{delete}',
			'deleteConfirmation'=>"js:'Are you sure you want to delete this evidence?'",
			'buttons'=>array(
				'view'=>array(
					'url'=>'Yii::app()->createUrl("/evidence/evidence/view", array("id"=>$data->evidenceid))'
				),
				'update'=>array(
					'url'=>'Yii::app()->createUrl("/evidence/evidence/update", array("id"=>$data->evidenceid))'
				),
				'delete'=>array(
					'label'=>'Delete Evidence',
					'url'=>'Yii::app()->createUrl("/evidence/evidence/delete", 
						array("id"=>$data->evidenceid))'
				),
			),
		),
	),
)); 

Yii::app()->clientScript->registerScript('addEvidence', "
$('.evidence-button').click(function(){
	$('.add-evidence').toggle();
	return false;
});");

echo CHtml::link('Add Evidence','#',array('class'=>'evidence-button')); ?>
<div class="add-evidence" style="display:none">
<?php $this->renderPartial('../evidence/_changeEvidenceForm',array('summary'=>$case, 'evidence'=>$evidence)); ?>
</div><!-- changeEvidenceForm -->
