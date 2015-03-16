<?php
/* @var $this EmailController */
/* @var $defName String */
/* @var $caseNumber String */
/* @var $yourName String */
/* @var $yourEmail String */
/* @var $yourNumber String */
/* @var $yourExtension String */
/* @var $requestType String */

echo "<br/>------------------------------------------------------------------------<br/>";
echo "Preliminary Hearing Request<br/>";
echo "------------------------------------------------------------------------<br/>";
echo "          Defendants Full Name: " . $defName . "<br/>";
echo "          Case Number: " . $caseNumber . "<br/>";
echo "          Your Name: " . $yourName . "<br/>";
echo "              Your Email: " . $yourEmail . "<br/>";
echo "              Contact Number: " . $yourNumber . " Ext. " . $yourExtension . "<br/>";
echo "              This is a " . $requestType . " Request.<br/>";
echo "------------------------------------------------------------------------<br/>";
echo "          IP Address: " . $_SERVER['REMOTE_ADDR'] . "<br/>";
echo "------------------------------------------------------------------------<br/>";
?>