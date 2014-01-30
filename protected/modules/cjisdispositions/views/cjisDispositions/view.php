<?php
/* @var $this CjisDispositionsController */
/* @var $model CjisDispositions */

$this->breadcrumbs=array(
	'CJIS Dispositions'=>array('index'),
	$model->dispoid,
);

$this->menu2=array(
	array('label'=>'List CJIS Dispositions', 'url'=>array('index')),
	array('label'=>'Create CJIS Disposition', 'url'=>array('create')),
	array('label'=>'Update CJIS Disposition', 'url'=>array('update', 'id'=>$model->dispoid)),
	array('label'=>'Delete CJIS Disposition', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->dispoid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CJIS Dispositions', 'url'=>array('admin')),
);
?>

<h1>View CJIS Disposition</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'court',
		'caseno',
		'lastname',
		'firstname',
		array(        
			'name'=>'dateofbirth',
			'value'=>isset($model->dateofbirth)?CHtml::encode(date('m/d/Y', strtotime($model->dateofbirth))):"N\\A"
		),
		'gender',
		'race',
		array( 
			'name'=>'count', 
			'value'=>(!$model->count == 0) 
						? $model->count
						: "",
		),
		'offensedescription',
		'offensetype',
		'disposition',
		array(        
			'name'=>'dateconcluded',
			'value'=>isset($model->dateconcluded)?CHtml::encode(date('m/d/Y', strtotime($model->dateconcluded))):"N\\A"
		),
		'location',
		array( 
			'name'=>'incarcerationyears', 
			'value'=>(!$model->incarcerationyears == 0) 
						? $model->incarcerationyears
						: "",
		),
		'incarcerationmonths',
		'incarcerationdays',
		'incarcerationhours',
		array( 
			'name'=>'percentage', 
			'value'=>(is_null($model->percentage)) 
						? $model->percentage . "%"
						: "0%",
		),
		'suspendallbut',
		array( 
			'name'=>'suspendpercentage', 
			'value'=>(is_null($model->suspendpercentage)) 
						? $model->suspendpercentage . "%"
						: "0%",
		),
		'dayfordayflag',
		'hourforhourflag',
		'suspendedflag',
		'noworkdetailflag',
		'workreleaseflag',
		array( 
			'name'=>'workreleasepercentage', 
			'value'=>(is_null($model->workreleasepercentage)) 
						? $model->workreleasepercentage . "%"
						: "0%",
		),
		'earlyreleaseflag',
		'timeservedcredit',
		'specifiedjailcreditmonths',
		'specifiedjailcreditdays',
		'specifiedjailcredithours',
		'incarcerationspecialconditions',
		'probationtype',
		'probationyears',
		'probationmonths',
		'probationdays',
		'probationspecialconditions',
		'restitutionamount',
		'courtfines',
		'finesspecialcondition',
	),
)); ?>
