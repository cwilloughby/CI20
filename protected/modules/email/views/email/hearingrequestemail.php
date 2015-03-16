<?php
/* @var $this EmailController */
/* @var $requestType String */

$this->pageTitle = Yii::app()->name . ' - Request Submitted';
?>

<h1 align="center">Your Hearing Request Has Been Submitted</h1>

<p align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Thank
  you for your request.</b></font></p>

<p align='center'><b><font face='Verdana, Arial, Helvetica, sans-serif' size='2'>
	Once your request is processed, you will receive a confirmation via email.

<?php
// Determine if the return link should go to the PD Request Form or the DA Request Form.
// Then create that link.
if($requestType == "Public Defender")
	echo "<a href='http://ci2/hearingrequest/hearingrequest/pdrequest'>Click Here</a>";
else
	echo "<a href='http://ci2/hearingrequest/hearingrequest/darequest'>Click Here</a>";
?>

to return to the Preliminary Hearing request form.</font></b></p>