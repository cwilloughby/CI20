<?php
/* @var $this SiteController */
/* @var $news News */

$this->pageTitle=Yii::app()->name;
?>

<div class="non-semantic-protector">
	<h1 class="ribbon">
		<strong class="ribbon-content">Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></strong>
	</h1>
</div>

<p>This is an Intranet website and can only be accessed from a computer 
inside the Metro/JIS Domain, just open an internet window and in the
URL address type "ci2" and hit "enter".</p>

<p>Please create an account under the login if you have not already done so.
You must be a Criminal Court Clerk employee to create an account. 
Site functions are disabled until you have logged in.</p>

<?php 
foreach($news as $key => $value)
{
	echo "<fieldset class='news'>";
	echo "<legend>" . $key . "</legend>";
	echo "<br/><p>" . $value . "</p>";
	echo "</fieldset>";
}

$this->widget('WeatherReport');
?>
