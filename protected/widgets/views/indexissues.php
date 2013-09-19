<?php
/* @var $this IssueTrackerController */
/* @var $dataProvider CActiveDataProvider */
?>
<div id="issues">
<?php 
$this->widget('CustomSmallListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_viewIssue',
	'template'=>"{summary}\n{items}\n{pager}",
));
?>
</div>