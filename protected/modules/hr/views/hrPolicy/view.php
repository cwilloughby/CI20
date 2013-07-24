<?php
/* @var $this HrPolicyController */
/* @var $model HrPolicy */

$this->pageTitle = Yii::app()->name . ' - View HR Policy';

$this->breadcrumbs=array(
	'HR Policies'=>array('index'),
	$model->policyid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search HR Policies', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-file"></i> Create HR Policy', 'url'=>array('createpolicy')),
	array('label'=>'<i class="icon icon-list-alt"></i> List HR Policies', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-edit"></i> Update HR Policy', 'url'=>array('updatePolicy', 'id'=>$model->policyid)),
	array('label'=>'<i class="icon icon-trash"></i> Delete HR Policy', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->policyid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View HR Policy #<?php echo $model->policyid; ?></h1>

<?php if(Yii::app()->user->hasFlash('updated')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('updated'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'policyid',
		'policy',
	),
));

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
