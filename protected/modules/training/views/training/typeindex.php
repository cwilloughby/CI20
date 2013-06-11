<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */
/* @var $types Array */

$this->pageTitle = Yii::app()->name . ' - List Training Resources';

$this->breadcrumbs=array(
	'Training',
);

$this->menu2=array(
	array('label'=>'List Training Resources', 'url'=>array('typeIndex')),
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

<h1>Training Resources</h1>
<br/>

<?php 
$this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); 
?>

<h4>For More Training Materials Try:</h4>
<a href="http://www.gcflearnfree.org/">www.gcflearnfree.org</a>