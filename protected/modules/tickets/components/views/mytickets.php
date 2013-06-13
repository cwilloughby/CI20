<?php
/* @var $this SiteController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>My <?php echo $status; ?> Tickets</h1>

<?php 
$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
)); 
?>

