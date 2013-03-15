<?php
/* @var $this DefendantController */
/* @var $model Defendant */
/* @var $cases CaseSummary */

$this->breadcrumbs=array(
	'Defendant'=>array('index'),
	$model->defid,
);

$this->menu=array(
	array('label'=>'List Defendants', 'url'=>array('index')),
	array('label'=>'Create Defendant', 'url'=>array('create')),
	array('label'=>'Update Defendant', 'url'=>array('update', 'id'=>$model->defid)),
	array('label'=>'Delete Defendant', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->defid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Defendants', 'url'=>array('admin')),
);
?>

<h1>View Defendant #<?php echo $model->defid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fname',
		'lname',
		'oca',
	),
)); 
echo "<br/><h4>" . CHtml::encode('Cases') . "</h4>";
// Output a list of all the cases that this defendant has been in with hyperlinks to each case's summary page.
foreach($cases as $key => $case)
{
	echo CHtml::link(CHtml::encode($case->caseno . ' ' . date("m/d/Y", strtotime($case->hearingdate))), 
		array('/evidence/caseSummary/view', 'id'=>$case->summaryid)) . "<br/>";
}
?>
