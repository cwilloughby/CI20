
<div class="row-fluid" id="templatemo_wrapper">
	<div class="templatemo_body">
		<div id="templatemo_middle">
			<?php
			if(!isset(Yii::app()->user->id))
			{
				?>
				<div class="row-fluid">

					<div class="span3">
						<?php $this->widget('UserLogin'); ?>
					</div>
					<div class="span6">
						<h1>Welcome to CI2.0</h1>
						<p>This is an Intranet website and can only be accessed from a computer 
						inside the Metro/JIS Domain, just open an internet window and in the
						URL address type "ci2" and hit "enter".</p>

						<p>Please create an account under the login if you have not already done so.
						You must be a Criminal Court Clerk employee to create an account. 
						Site functions are disabled until you have logged in.</p>

						<p>We hope you enjoy the new CI site.</p>
						<br/>
						<?php
						//echo "<h4>12 Hour Forecast</h4>";
						//$this->widget('WeatherReport');
						?>
					</div>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="row-fluid">
					<div class="span1">

					</div>
					<div class="span8">
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
						echo "<h4>12 Hour Forecast</h4>";
						$this->widget('WeatherReport');
						?>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span3">
						<?php 
						echo "<h4>Office News</h4>";
						$this->widget('NewsReport');
						echo "<a href='" . $this->createAbsoluteUrl("/news/news/index") . "'> View All Posts</a>" 
						?>
					</div>
					<div class="span3">
						<?php
						echo "<h4>Court News</h4>";
						$this->widget('NewsReport', array('type'=>'Court News'));
						echo "<a href='" . $this->createAbsoluteUrl("/news/news/index") . "'> View All Posts</a>" 
						?>
					</div>
					<div class="span3">
						<?php 
						echo "<h4>Finance News</h4>";
						$this->widget('NewsReport', array('type'=>'Finance News'));
						echo "<a href='" . $this->createAbsoluteUrl("/news/news/index") . "'> View All Posts</a>" 
						?>
					</div>
					<div class="span3">
						<?php 
						echo "<h4>IT News</h4>";
						$this->widget('NewsReport', array('type'=>'IT News'));
						echo "<a href='" . $this->createAbsoluteUrl("/news/news/index") . "'> View All Posts</a>" 
						?>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>


