
<div id="templatemo_wrapper">
	
	<div id="templatemo_body">
	
	<div class="row-fluid">
		<div class="span12" id="nivo">
			<div id="slider">
				<a href="#" target="_parent"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/01.jpg" alt="01" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit." /></a>
				<a href="#" target="_parent"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/02.jpg" alt="02" title="Nullam ante leo, consectetur eget adipiscing et." /></a>
				<a href="#" target="_parent"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/03.jpg" alt="03" title="Suspendisse sit amet enim elit. Curabitur tempor consequat." /></a>
				<a href="#" target="_parent"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/04.jpg" alt="04" title="Nulla faucibus luctus quam eget placerat." /></a>
				<a href="#" target="_parent"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/slideshow/05.jpg" alt="05" title="Phasellus aliquet viverra posuere." /></a>
			</div>
		</div>
    </div>
	
	<div class="row-fluid">
		<div id="templatemo_middle">
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
			</div>
			<div class="span3">
				<?php 
				echo "<h4>News</h4>";
				$this->widget('NewsReport');
				?>
			</div>
		</div>
	</div>

	<div class="row-fluid">
    <div id="templatemo_content">
		
    	<div class="span6">
        	<h2>Photo Gallery</h2>
            <ul class="gallery">
            	<li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_02.jpg" alt="image 2" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_03.jpg" alt="image 3" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_04.jpg" alt="image 4" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_05.jpg" alt="image 5" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_06.jpg" alt="image 6" /></a></li>
                <li><a href="#"><img src="<?php echo Yii::app()->theme->baseUrl;?>/images/templatemo_image_07.jpg" alt="image 7" /></a></li>
            </ul>
        </div>
        
        <div class="span6">
			<div class="row-fluid">
				<div class="span10">
					<h2>High Quality Products</h2>
				</div>
				<div class="span5">
					<ul class="tmo_list">
						<li><a href="#">&raquo; Morbi sed vehicula augue</a></li>
						<li><a href="#">&raquo; Vestibulum suscipit</a></li>
						<li><a href="#">&raquo; Risus sed fermentum</a></li>
						<li><a href="#">&raquo; Feugiat risus ligula</a></li>
					</ul>
				</div>
				<div class="span5">
					<ul class="tmo_list">
						<li><a href="#">&raquo; Morbi sed vehicula augue</a></li>
						<li><a href="#">&raquo; Vestibulum suscipit</a></li>
						<li><a href="#">&raquo; Risus sed fermentum</a></li>
						<li><a href="#">&raquo; Feugiat risus ligula</a></li>
					</ul>
				</div>
            </div>
			
			<div class="row-fluid">
				<p><a href="#"><strong>Quisque in diam a justo condimentum molestie. Cum sociis natoque penatibus et magnis dis parturient montes.</strong></a></p>
				<p>Curabitur quis velit quis tortor tincidunt aliquet. Vivamus leo velit, convallis id, ultrices sit amet, tempor a, libero.</p>
				<p>Quisque rhoncus nulla quis sem. Mauris quis nulla sed ipsum pretium sagittis. Suspendisse feugiat. Ut sodales libero ut odio. Maecenas venenatis metus eu est. In sed risus ac felis varius bibendum. Nulla imperdiet congue metus.</p>
            </div>
		</div>
    </div>
	</div>
</div>
</div>
