<?php
/* @var $this linksController */
/* @var $printers array */
/* @var $copiers array */

$this->pageTitle = Yii::app()->name . ' - Printers & Copiers';

$this->breadcrumbs=array(
	'Links'
);
?>
<h3>Copiers</h3>

<?php
foreach($copiers as $copier)
{
	echo "<a href='" . $copier['Address'] . "'>" . $copier['Name'] . "</a><br/>";
}
?>

<br/>
<h3>Printers</h3>

<?php
foreach($printers as $printer)
{
	echo "<a href='" . $printer['Address'] . "'>" . $printer['Name'] . "</a><br/>";
}
