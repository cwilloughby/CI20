<?php
/* @var $this SiteController */
/* @var $tracker IssueTracker */
?>
<div id="issues">

<?php echo $this->render('_formIssueSearch', array('model'=>$tracker)); ?>
</div>