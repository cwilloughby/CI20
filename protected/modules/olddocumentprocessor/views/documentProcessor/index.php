<?php
/* @var $this DocumentsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Documents',
);

$this->menu=array(
	array('label'=>'Search Documents', 'url'=>array('admin')),
	array('label'=>'Create Documents', 'url'=>array('create')),
	array('label'=>'List Documents', 'url'=>array('index')),
);
?>

<h1>Documents</h1>

<?php if(Yii::app()->user->hasFlash('deleted')):?>
    <div class="info">
        <?php echo Yii::app()->user->getFlash('deleted'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
));

Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".info").animate({opacity: 1.0}, 3000).fadeOut("slow");',
   CClientScript::POS_READY
);
