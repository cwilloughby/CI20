<?php
/* @var $this IssueSearcher */
/* @var $data IssueTracker */
?>

<div class="view">

	<?php echo CHtml::link(CHtml::encode(strip_tags($this->customTruncate($data->description, 100))),
			array('issuetracker/issuetracker/view', 'id'=>$data->id)); ?>
	<br/>

</div>