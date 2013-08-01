<?php foreach($comments as $comment): ?>
<fieldset class="news">
	<legend>
		<?php echo CHtml::encode($comment->createdby0->username) . " on " 
			. date('F j, Y \a\t h:i a',strtotime($comment->datecreated)); ?>
	</legend>

	<p>
		<?php echo nl2br($comment->content); ?>
	</p>
</fieldset><!-- comment -->
<?php endforeach; ?>
