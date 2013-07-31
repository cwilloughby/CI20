<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs=array(
	'News'=>array('index'),
	$model->newsid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search News Posts', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-file"></i> Create News Post', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-list-alt"></i> List News Posts', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View News Post', 'url'=>array('view', 'id'=>$model->newsid)),
	array('label'=>'<i class="icon icon-edit"></i> Update News Post', 'url'=>array('update', 'id'=>$model->newsid), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
	array('label'=>'<i class="icon icon-trash"></i> Delete News Post', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->newsid),'confirm'=>'Are you sure you want to delete this item?'), 'visible' => Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
);
?>

<h1>View News #<?php echo $model->newsid; ?></h1>

<?php if(Yii::app()->user->hasFlash('updated')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('updated'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array(        
			'name'=>'typeid',
			'value'=>isset($model->type)?CHtml::encode($model->type->type):"Unknown"
		),
		array(        
			'name'=>'postedby',
			'value'=>isset($model->postedby0)?CHtml::encode($model->postedby0->username):"Unknown"
		),
		array(        
			'name'=>'date',
			'value'=>isset($model->date)?CHtml::encode(date('g:i a m/d/Y', strtotime($model->date))):"N\\A"
		),
		array(
			'name'=>'news',
			'value'=>nl2br($model->news),
			'type'=>'raw',
		),
	),
));

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);