
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
					</div>
				</div>
				<?php
			}
			else
			{
				?>
				<div class="row-fluid">
					<div class="span2">

					</div>
					<div class="span9">
						<h1>Welcome to CI2.0</h1>
						<p>This is an Intranet website and can only be accessed from a computer 
						inside the Metro/JIS Domain, just open an internet window and in the
						URL address type "ci2" and hit "enter".</p>

						<p>Please create an account under the login if you have not already done so.
						You must be a Criminal Court Clerk employee to create an account. 
						Site functions are disabled until you have logged in.</p>

						<p>We hope you enjoy the new CI site.</p>
					</div>
				</div>
				<div class="row-fluid news-row">
					<div class="span6 news-slider">
						<?php 
						echo "<h4 class='news-title'>Office News</h4>";
						echo "<a class='all-news' href='" . $this->createAbsoluteUrl("/news/news/index") . "'> View All Posts</a>";
						$this->widget('NewsReport');
						?>
					</div>
					<div class="span6 news-slider">
						<?php 
						echo "<h4 class='news-title'>IT News</h4>";
						echo "<a class='all-news' href='" . $this->createAbsoluteUrl("/news/news/index") . "'> View All Posts</a>";
						$this->widget('NewsReport', array('type'=>'IT News'));
						?>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>
