<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */

$this->pageTitle = Yii::app()->name . ' - Issue Tracker';

$this->breadcrumbs=array(
	'Issue Tracker'=>array('index'),
	$model->key,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search CJIS Issues', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create CJIS Issue', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List CJIS Issues', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View CJIS Issue', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'<i class="icon icon-edit"></i> Update CJIS Issue', 'url'=>array('update', 'id'=>$model->id), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list"></i> Change Priority Order', 'url'=>array('changepriorities'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-trash"></i> Delete CJIS Issue', 'url'=>'#', 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this issue?')),
);
?>

<h1>View CJIS Issue <?php echo $model->key; ?></h1>

<?php if(Yii::app()->user->hasFlash('updated')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('updated'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'key',
		'type',
		array(        
			'name'=>'created',
			'value'=>isset($model->created)?CHtml::encode(date('m/d/Y', strtotime($model->created))):"N\\A"
		),
		'reporter',
		'summary',
		'description',
		'assigned',
		array(        
			'name'=>'updated',
			'value'=>isset($model->updated)?CHtml::encode(date('m/d/Y', strtotime($model->updated))):"N\\A"
		),
		'originalestimate',
		'remainingestimate',
		'timespent',
		'resolution',
		'priority',
	),
));

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
