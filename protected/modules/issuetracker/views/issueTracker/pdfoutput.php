<?php
/* @var $this IssueTrackerController */
/* @var $model IssueTracker */
?>
<page backtop="7mm" backbottom="7mm" backleft="7mm" backright="7mm"> 

	<page_footer> 
		Page [[page_cu]] of [[page_nb]]
	</page_footer> 
	
<?php
	echo "<b>" . $model->key . "</b><br/><br/>";
	
	if((int)$model->created)
		echo "<b>Created: </b>" . date('m/d/Y', strtotime($model->created)) . "<br/><br/>";
	
	echo "<b>Reported By: </b>" . $model->reporter . "<br/><br/>";
	
	echo "<b>Summary: </b>" . $model->summary . "<br/><br/>";
	
	echo "<b>Description: </b>" . $model->description . "<br/><br/>";
?>

</page>