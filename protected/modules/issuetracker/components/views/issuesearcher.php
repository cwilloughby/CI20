<?php
/* @var $this SiteController */
/* @var $tracker IssueTracker */
?>
<div id="issues">
<h1>Search Issues</h1>

<?php echo $this->render('_form', array('model'=>$tracker)); ?>
</div>