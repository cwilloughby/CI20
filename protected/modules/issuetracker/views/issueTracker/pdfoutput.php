<?php
/* @var $this IssueTrackerController */
/* @var $dataProvider CActiveDataProvider */
?>
<page backtop="7mm" backbottom="7mm" backleft="7mm" backright="7mm"> 

	<page_footer> 
		Page [[page_cu]] of [[page_nb]]
	</page_footer> 
	
	<?php
	$key = CHtml::listData($dataProvider->getData(), 'id', 'key');
	$created = CHtml::listData($dataProvider->getData(), 'id', 'created');
	$reported = CHtml::listData($dataProvider->getData(), 'id', 'reporter');
	$summary = CHtml::listData($dataProvider->getData(), 'id', 'summary');
	$desc = CHtml::listData($dataProvider->getData(), 'id', 'description');
	
	foreach($summary as $id=>$content)
	{
		echo "<b>" . $key[$id] . "</b><br/><br/>";

		if((int)$created[$id])
			echo "<b>Created: </b>" . date('m/d/Y', strtotime($created[$id])) . "<br/><br/>";

		echo "<b>Reported By: </b>" . $reported[$id] . "<br/><br/>";

		echo "<b>Summary: </b>" . $summary[$id] . "<br/><br/>";

		echo "<b>Description: </b>" . $desc[$id] . "<br/><br/><hr/>";
	}
	?>

</page>