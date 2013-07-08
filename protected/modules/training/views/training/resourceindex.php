<?php
/* @var $this TrainingController */
/* @var $videoProvider CActiveDataProvider */
/* @var $docProvider CActiveDataProvider */
/* @var $pageProvider CActiveDataProvider */
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
<h3><?php echo "Videos"; ?></h3>
<br/>

<?php 
$this->widget('VideoList', array(
	'dataProvider'=>$videoProvider,
	'itemView'=>'_viewResource',
	'template'=>"{summary}\n{items}\n{pager}",
	'columnCount'=>5
));
?>
<h3><?php echo "Documents"; ?></h3>
<?php
$this->widget('VideoList', array(
	'dataProvider'=>$docProvider,
	'itemView'=>'_viewResource',
	'template'=>"{summary}\n{items}\n{pager}",
	'columnCount'=>5
));
?>
<h3><?php echo "Office Reference Sheets"; ?></h3>
<?php
$this->widget('VideoList', array(
	'dataProvider'=>$pageProvider,
	'itemView'=>'_viewResource',
	'template'=>"{summary}\n{items}\n{pager}",
	'columnCount'=>5
));
?>