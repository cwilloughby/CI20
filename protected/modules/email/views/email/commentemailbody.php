<?php
/* @var $this EmailController */
/* @var $ticketID String */
/* @var $user String */
/* @var $content String */
/* @var $ticketBody String */
?>

<h1>A new comment on CI ticket #<?php echo $ticketID; ?> was made by </h1> <?php echo $user; ?><br/><br/>
<p>Content: <?php echo $content; ?></p>
<p>Original Ticket Message: <br/><?php echo $ticketBody; ?></p>