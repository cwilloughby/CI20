<?php
/* @var $this AttorneyController */
/* @var $model Attorney */
/* @var $cases Array */

$this->breadcrumbs=array(
	'Attorney'=>array('index'),
	$model->attyid,
);

$this->menu=array(
	array('label'=>'List Attorneys', 'url'=>array('index')),
	array('label'=>'Create Attorney', 'url'=>array('create')),
	array('label'=>'Update Attorney', 'url'=>array('update', 'id'=>$model->attyid)),
	array('label'=>'Delete Attorney', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->attyid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Attorneys', 'url'=>array('admin')),
);
?>

<h1>View Attorney #<?php echo $model->attyid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fname',
		'lname',
		'type',
		'barid',
	),
)); 

echo "<br/><h4>" . CHtml::encode('Cases') . "</h4>";
// Output a list of all the cases that the attorney has worked on with hyperlinks to each case's summary page.
foreach($cases as $key => $case)
{
	echo CHtml::link(CHtml::encode($case['caseno'] . ' ' . date("m/d/Y", strtotime($case['hearingdate']))), 
		array('/evidence/caseSummary/view', 'id'=>$case['summaryid'])) . "<br/>";
}
?>
