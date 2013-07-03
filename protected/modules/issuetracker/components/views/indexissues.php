<?php
/* @var $this IssueTrackerController */
/* @var $dataProvider CActiveDataProvider */
?>
<div id="issues">
<?php 
$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{items}\n{pager}",
));
?>
</div>