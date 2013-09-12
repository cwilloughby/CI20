<?php
//
// jQuery File Tree PHP Connector
//
// Version 1.01
//
// Cory S.N. LaViska
// A Beautiful Site (http://abeautifulsite.net/)
// 24 March 2008
//
// History:
//
// 1.01 - updated to work with foreign characters in directory/file names (12 April 2008)
// 1.00 - released (24 March 2008)
//
// Output a list of files for jQuery File Tree
//
$root = isset($root) ? $root : "";
$_POST['dir'] = urldecode($_POST['dir']);

session_start();
if(isset($_SESSION['provider']))
{
	$provider = unserialize($_SESSION['provider']);
	$data = $provider->dataProvider->getData();
	
	foreach($data as $i=>$item)
	{
		$out['index']=$i;
		$out['data']=$item;
		print_r($out);
	}
}
// If the specified root directory exists.
if(file_exists($root . $_POST['dir']))
{
	// Grab all the files and folders in a directory.
	$files = scandir($root . $_POST['dir']);
	// Sort the array into a natural order.
	natcasesort($files);
	// If the directory is not empty.
	// The 2 accounts for . and ..
	if(count($files) > 2)
	{
		echo "<ul class='jqueryFileTree' style='display: none;'>";
		// All dirs.
		foreach($files as $file)
		{
			if(file_exists($root . $_POST['dir'] . $file) 
				&& $file != '.' 
				&& $file != '..' 
				&& is_dir($root . $_POST['dir'] . $file)) 
			{
				echo "<li class='directory collapsed'><a href='#' rel='" . htmlentities($_POST['dir'] . $file) . "/'>" . htmlentities($file) . "</a></li>";
			}
		}

		// All files.
		foreach($files as $file) 
		{
			if(file_exists($root . $_POST['dir'] . $file) 
				&& $file != '.' 
				&& $file != '..' 
				&& !is_dir($root . $_POST['dir'] . $file)) 
			{
				$ext = preg_replace('/^.*\./', '', $file);
				echo "<li class='file ext_$ext'>
					<input type='checkbox' name='C:$_POST[dir]' value='C:$_POST[dir]$file' style='float:left;'>
					<a href='#' rel='" . htmlentities($_POST['dir'] . $file) . "'>" . htmlentities($file) . "</a>
					</li>";
			}
		} 

		echo "</ul>";
	}
}
?>