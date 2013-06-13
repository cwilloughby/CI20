<?php
/* @var $this IssueTrackerController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php 
$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{pager}\n{items}\n{pager}",
));
?>
