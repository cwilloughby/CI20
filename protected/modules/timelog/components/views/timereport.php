<?php
/* @var $this TimeLogController */
/* @var $ciLog Array */
/* @var $computerLog Array */

echo "Your last CI2 login was:<br/>" . CHtml::encode(date('m/d/Y \a\t g:i a', strtotime($ciLog[0]['eventdate'])));
if(!is_null($computerLog))
{
	echo "<br/>Your last known computer login was:<br/>" . CHtml::encode(date('m/d/Y \a\t g:i a', strtotime($computerLog[0]['eventtime'] . " " . $computerLog[0]['eventdate'])));
}
?>