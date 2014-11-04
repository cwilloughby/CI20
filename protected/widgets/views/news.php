<?php
/* @var $this NewsController */
/* @var $news Array */
/* @var $dates Array */
/* @var $type String */

$count = 0;
foreach($news as $key => $value)
{
	if($key != "")
	{
		echo CHtml::encode(date('m/d/Y \a\t g:i a', strtotime($dates[$key])));
		echo "<br/>" . CHtml::link($value, array('/news/news/view', 'id'=>$key), array('class'=>'news'));
		if($count != 4)
		{
			echo "<hr class='newsrule'>";
			$count++;
		}
	}
}
?>
