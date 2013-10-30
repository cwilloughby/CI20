
<div class="row-fluid" id="templatemo_wrapper">
	<div class="templatemo_body">
		<div class="row-fluid">
		<div class="span12 flexslider">
			<ul class="slides">
				<li>
					<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/01.jpg" alt="01"/>
					<p class="flex-caption">This image has a caption!</p>
				</li>
				<li>
					<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/02.jpg" alt="02"/>
					<p class="flex-caption">This image has a caption!</p>
				</li>
				<li>
					<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/03.jpg" alt="03"/>
					<p class="flex-caption">This image has a caption!</p>
				</li>
				<li>
					<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/04.jpg" alt="04"/>
					<p class="flex-caption">This image has a caption!</p>
				</li>
				<li>
					<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/05.jpg" alt="05"/>
					<p class="flex-caption">This image has a caption!</p>
				</li>
			</ul>
		</div>
		</div>
		<div class="row-fluid" id="templatemo_middle">
			<div class="span4 v_divider">
				<?php
				if(!isset(Yii::app()->user->id))
					$this->widget('UserLogin');
				else
				{
					echo "<h4>Last Login</h4>";
					$this->widget('TimeReport');
					echo "<h4>Weather</h4>";
					$this->widget('WeatherReport');
				}
				?>
			</div>

			<div class="span5 v_divider">
				<h1>Welcome to CI2.0</h1>
				<p>This is an Intranet website and can only be accessed from a computer 
				inside the Metro/JIS Domain, just open an internet window and in the
				URL address type "ci2" and hit "enter".</p>

				<p>Please create an account under the login if you have not already done so.
				You must be a Criminal Court Clerk employee to create an account. 
				Site functions are disabled until you have logged in.</p>

				<p>We hope you enjoy the new CI site.</p>
			</div>

			<div class="span3">
				<?php 
				//echo "<h4>News</h4>";
				//$this->widget('NewsReport');
				?>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="templatemo_body">
	<div class="span9 v_divider">
		<h4>Photo Gallery</h4>
		<ul class="gallery">
			<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_02.jpg" alt="image 2" /></a></li>
			<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_03.jpg" alt="image 3" /></a></li>
			<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_04.jpg" alt="image 4" /></a></li>
			<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_05.jpg" alt="image 5" /></a></li>
			<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_06.jpg" alt="image 6" /></a></li>
			<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_07.jpg" alt="image 7" /></a></li>
		</ul>
	</div>

	<div class="span3">
		<?php 
		//echo "<h4>IT News</h4>";
		//$this->widget('NewsReport', array('type'=>'IT News'));
		?>
	</div>
	</div>
</div>
