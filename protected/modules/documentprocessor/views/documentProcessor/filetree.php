<?php
$this->widget('application.extensions.filetree.SFileTree',
	array(
		"div"=>"filetree",
		"root"=>"/wamp/files/",
		"multiFolder"=>"true",
		"expandSpeed"=>500,
		"collapseSpeed"=>500,
		"callback"=>"window.alert('C:' + file)",
	)
);
