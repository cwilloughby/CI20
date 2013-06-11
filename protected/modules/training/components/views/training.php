<?php
/* @var $this TrainingController */
/* @var $dataProvider CActiveDataProvider */
?>

<h1>Training Resources</h1>
<br/>

<?php 
$this->widget('CustomListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{summary}\n{items}\n{pager}",
)); 
?>

<h4>For More Training Materials Try:</h4>
<a href="http://www.gcflearnfree.org/">www.gcflearnfree.org</a>
