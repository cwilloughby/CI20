<?php
/* @var $this TimeLogController */
/* @var $ciLog Array */
/* @var $computerLog Array */

echo "Your last CI2 login was:<br/>" . CHtml::encode($ciLog);

echo "<br/>Your last known computer login was:<br/>" . CHtml::encode($computerLog);
?>