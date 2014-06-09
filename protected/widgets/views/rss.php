<?php
/* @var $this RSSWidget */
/* @var $rss Array */

echo "<ul class='slides'>";
$cnt =  count($rss);
for($i=0; $i < $cnt; $i++)
{
	echo "<li>";
	echo '<img src="/../../../../images/rss.png" alt="RSS" style="width:90px;height:90px"/>';
	echo "<p class='flex-caption'>" . $rss[$i]['title'] . "</p>";
	echo "</li>";
}
echo "</ul>";
