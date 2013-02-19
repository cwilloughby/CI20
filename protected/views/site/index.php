<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'News',
);

$this->menu=array(
	array('label'=>'Create News', 'url'=>array('create')),
	array('label'=>'Manage News', 'url'=>array('admin')),
);
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>This is an Intranet website and can only be accessed from a computer 
inside the Metro/JIS Domain, just open an internet window and in the
URL address type "ci" and hit "enter".</p>

<p>Please create an account under the login if you have not already done so.
You must be a Criminal Court Clerk employee to create an account. 
Site functions are disabled until you have logged in.</p>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
