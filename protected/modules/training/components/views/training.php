<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{items}\n{pager}",
)); 
?>

<h5>For More Training Materials Try:</h5>
<a href="http://www.gcflearnfree.org/">www.gcflearnfree.org</a>
