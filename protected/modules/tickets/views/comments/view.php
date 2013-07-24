<?php
/* @var $this CommentsController */
/* @var $model Comments */

$this->pageTitle = Yii::app()->name . ' - View Comment';

$this->breadcrumbs=array(
	'Comments'=>array('index'),
	$model->commentid,
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-search"></i> Search Comments', 'url'=>array('admin')),
	array('label'=>'<i class="icon icon-list-alt"></i> List Comments', 'url'=>array('index')),
	array('label'=>'<i class="icon icon-zoom-in"></i> View Comment', 'url'=>array('view', 'id'=>$model->commentid)),
	array('label'=>'<i class="icon icon-edit"></i> Update Comment', 'url'=>array('update', 'id'=>$model->commentid)),
	array('label'=>'<i class="icon icon-trash"></i> Delete Comment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->commentid),'confirm'=>'Are you sure you want to delete this item?')),
);
?>

<h1>View Comment #<?php echo $model->commentid; ?></h1>

<?php if(Yii::app()->user->hasFlash('updated')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('updated'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'commentid',
		'content',
		array(        
			'name'=>'createdby',
			'value'=>isset($model->createdby0)?CHtml::encode($model->createdby0->username):"Unknown"
		),
		'datecreated',
	),
)); 

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
