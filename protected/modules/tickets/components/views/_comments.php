<?php foreach($comments as $comment): ?>
	<br/>
	<?php echo CHtml::encode($comment->createdby0->username) . " on " 
		. date('F j, Y \a\t h:i a',strtotime($comment->datecreated)); ?>

	<p>
		<?php echo nl2br($this->customTruncate(strip_tags($comment->content), 100)); ?>
	</p>

<?php endforeach; ?>
