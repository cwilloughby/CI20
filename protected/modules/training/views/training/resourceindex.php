<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */
/* @var $types Array */

$this->pageTitle = Yii::app()->name . ' - List Training Resources';

$this->breadcrumbs=array(
	'Training' => array('typeindex'),
	$_GET['type']
);

$this->menu2=array(
	array('label'=>'<i class="icon icon-list"></i> List Training Resources', 'url'=>array('typeIndex')),
);

$count = 1;
// This loop allows the side menu to be dynamic.
foreach($types as $key =>$value)
{
	$this->menu2 = array_merge($this->menu2, 
			array($count =>array('label'=>$value, 'url'=>array('resourceIndex', 'type'=>$value))));
	$count++;
}
?>

<h1><?php echo $_GET['type']; ?></h1>
<br/>

<?php 
$this->widget('VideoList', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewResource',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
	'columnCount'=>2
));
?>
