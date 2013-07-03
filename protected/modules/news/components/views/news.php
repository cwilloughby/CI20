<?php
/* @var $this NewsController */
/* @var $news Array */
/* @var $dates Array */
/* @var $type String */

foreach($news as $key => $value)
{
	echo date('m/d/Y \a\t g:i a', strtotime($dates[$key]));
	echo "<br/>" . CHtml::link($value, array('/news/news/view', 'id'=>$key), array('class'=>'news'));
	echo "<hr class='newsrule'>";
}
?>
