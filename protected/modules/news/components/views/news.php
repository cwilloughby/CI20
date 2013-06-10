<?php
/* @var $this NewsController */
/* @var $news Array */
?>

<?php 
foreach($news as $key => $value)
{
	echo "<h3>" . $key . "</h3>";
	echo "<br/><p>" . $value . "</p>";
}
?>
