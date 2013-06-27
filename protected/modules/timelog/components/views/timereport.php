<?php
/* @var $this NewsController */
/* @var $news Array */
/* @var $dates Array */
/* @var $type String */

foreach($news as $key => $value)
{
	echo "<hr/>";
	echo date('m/d/Y \a\t g:i a', strtotime($dates[$key]));
	echo "<p>" . CHtml::link($value, array('/news/news/view', 'id'=>$key), array('class'=>'news')) . "</p>";
}
?>
