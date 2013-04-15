<?php
/* @var $this EmailController */
/* @var $ticketID String */
/* @var $user String */
/* @var $category String */
/* @var $subject String */
/* @var $description String */
/* @var $resolution String */
?>

<h1>CI ticket #<?php echo $ticketID;?> was closed by: </h1><b><?php echo $user; ?></b><br/><br/>

<ul>
	<li>Category: <?php echo $category; ?></li>
	<li>Subject: <?php echo $subject; ?></li>
	<li>Description: <?php echo $description; ?> </li>
	<li>Resolution: <?php echo $resolution; ?></li>
<ul>