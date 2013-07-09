<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>

<div class="row-fluid">
	<div class="span3">
		<?php
		if(!isset(Yii::app()->user->id))
			$this->widget('UserLogin');
		else
		{
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon-globe"></span> <b>Last Login</b>',
				'titleCssClass'=>'',
				'contentCssClass'=>'portlet-content outer-portlet portlet_border small-portlet',
                                'id'=>'lastlogin'
			));
			?>
			<div class="textdiv bigwhitefont">
				<?php $this->widget('TimeReport'); ?>
			</div>
			<div class="imgdiv">
				<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/login1.jpg' class='overimage-small'>"; ?>
			</div>
			<?php
			$this->endWidget();

			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon-picture"></span> <b>12 Hour Forcast</b>',
				'titleCssClass'=>'',
				'contentCssClass'=>'portlet-content outer-portlet portlet_border small-portlet',
                                'id'=>'weather',
			));
			?>
			<div class="textdiv bigwhitefont">
				<?php $this->widget('WeatherReport'); ?>
			</div>
			<div class="imgdiv">
				<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/weather1.jpg' class='overimage-small'>"; ?>
			</div>
			<?php
			$this->endWidget();
		}
		?>
	</div>

	<div class="span6 ">
		<p>This is an Intranet website and can only be accessed from a computer 
		inside the Metro/JIS Domain, just open an internet window and in the
		URL address type "ci2" and hit "enter".</p>

		<p>Please create an account under the login if you have not already done so.
		You must be a Criminal Court Clerk employee to create an account. 
		Site functions are disabled until you have logged in.</p>
	</div>
	<div class="span3">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-bullhorn"></span><b> Criminal Court Clerk News</b>',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border medium-portlet',
                        'id'=>'clerknews'
		));?>
		<div class="textdiv bigwhitefont">
			<?php $this->widget('NewsReport');?>
		</div>
		<div class="imgdiv">
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/News.jpg' class='overimage'>"; ?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
			<?php 
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon-th-list"></span> <b>Quick Links</b>',
				'titleCssClass'=>'',
				'contentCssClass'=>'portlet-content outer-portlet portlet_border medium-portlet',
                                'id'=>'quicklinks'
			));?>
			<div class="textdiv bigwhitefont">
				<?php 
				if(!Yii::app()->user->checkAccess('DefaultExternal', Yii::app()->user->id) || (!isset(Yii::app()->user->id)))
				{
					$this->widget('zii.widgets.CMenu', array(
						/*'type'=>'list',*/
						'encodeLabel'=>false,
						'items'=>array(
							array('label'=>'<i class="icon icon-home"></i> Home', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'')),
							// The link to the trouble ticket form.
							array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('/tickets/troubletickets/create')),
							// The link to the hr policy page.
							array('label'=>'<i class="icon icon-th-list"></i> Human Resources', 'url'=>array('/hr/hrpolicy/index')),
							// The link to the emergency response plan.
							array('label'=>'<i class="icon icon-fire"></i> Emergency Response Plan', 'url'=>Yii::app()->baseUrl . '/assets/files/cep.pdf'),

							// Include the operations menu
							array('label'=>'OPERATIONS','items'=>$this->menu1),
						),
					));
				}
				else
				{
					$this->widget('zii.widgets.CMenu', array(
						/*'type'=>'list',*/
						'encodeLabel'=>false,
						'items'=>array(
							array('label'=>'<i class="icon icon-home"></i> Home', 'url'=>array('/site/index'),'itemOptions'=>array('class'=>'')),
							// The link to the trouble ticket form.
							array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('/tickets/troubletickets/create')),

							// Include the operations menu
							array('label'=>'OPERATIONS','items'=>$this->menu1),
						),
					));
				}
				?>
			</div>
			<div class="imgdiv">
				<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/quicklinks.jpg' class='overimage'>"; ?>
			</div>
			<?php $this->endWidget(); ?> 
		</div>
	</div>
	<div class="span3">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-file"></span> <b>Document Manager</b>',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border medium-portlet',
                       'id'=>'docmanager'
		));?>
		<div class="textdiv bigwhitefont">
			<?php $this->widget('NewsReport', array('type'=>'IT News'));?>
		</div>
		<div class="imgdiv">
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/docs.jpg'  class='overimage'>"; ?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
	<div class="span3">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-cog"></span><b> IT News</b>',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border medium-portlet',
                        'id'=>'itnews'
		));?>
		<div class="textdiv bigwhitefont">
			<?php $this->widget('NewsReport', array('type'=>'IT News'));?>
		</div>
		<div class="imgdiv">
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/itnews1.png' class='overimage'>"; ?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
	<div class="span3">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-book"></span> <b>Training Resources</b>',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border medium-portlet',
                        'id'=>'training'
		));?>
		<div class="textdiv bigwhitefont">
			<?php $this->widget('Training');?>
		</div>
		<div class="imgdiv">
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/img/training.jpg' class='overimage'>"; ?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
</div>
<div class="row-fluid">

	<div class="span4">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-tag"></span><span id="tickettitle"><b>My Open Tickets</b></span><img src="' . Yii::app()->theme->baseUrl . '/img/switch.png" class="switcher" style="float:right" onclick="ticketswitcher();">',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border large-portlet',
                        'id'=>'troubleticket'
		));
		?>
            <div id="myopentickets" class="bigwhitefont">
			<?php $this->widget('MyTickets');?>
        </div>
		<div id="createticket" class="bigwhitefont">
			<?php $this->widget('CreateTicketWid'); ?>
        </div>
		<div id="myclosedtickets" class="bigwhitefont">
			<?php $this->widget('MyTickets', array('status'=>'Closed'));?>
        </div>
        <?php $this->endWidget(); ?>
        
	</div>
	<div class="span4">
	  <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-print"></span><b>Project Paperless</b>',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border large-portlet',
                        'id'=>'paperless'
		));
		?>
        
        <div class="stacked-bars-chart bigwhitefont" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
        
        <?php $this->endWidget(); ?>
	</div><!--/span-->
	<div class="span4">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-search"></span><span id="issuetitle"><b>Search Issues</b></span><img src="' . Yii::app()->theme->baseUrl . '/img/switch.png" class="switcher" style="float:right" onclick="issueswitcher();">',
			'titleCssClass'=>'',
			'contentCssClass'=>'portlet-content outer-portlet portlet_border large-portlet',
                        'id'=>'issuetracker'    
		));
		?>
        <div id="issuesearcher" class="bigwhitefont">
			<?php $this->widget('IssueSearcher');?>
        </div>
		<div id="allissues">
			<?php $this->widget('IssueSearcher', array('type'=>'All'));?>
        </div>
        <?php $this->endWidget(); ?>
	</div>
</div>

<div class="row-fluid">
    <!--</div>
	<div class="span2">
    	<input class="knob" data-width="100" data-displayInput=false data-fgColor="#5EB95E" value="35">
    </div>
	<div class="span2">
     	<input class="knob" data-width="100" data-cursor=true data-fgColor="#B94A48" data-thickness=.3 value="29">
    </div>
	<div class="span2">
         <input class="knob" data-width="100" data-min="-100" data-fgColor="#F89406" data-displayPrevious=true value="44">     	
	</div><!--/span-->
</div><!--/row-->

          


<script>

var counter = {
    ticketSwitchCount: 1,
	issueSwitchCount: 1
};

function ticketswitcher()
{
	var data = counter.ticketSwitchCount;
	
	if((data % 3) == 1)
	{
		$("div #tickettitle").html('Create Trouble Ticket');
		$("div #myopentickets").css("display","none");
		$("div #createticket").css("display","block");
	}
	else if((data % 3) == 2)
	{
		$("div #tickettitle").html('My Closed Tickets');
		$("div #createticket").css("display","none");
		$("div #myclosedtickets").css("display","block");
	}
	else
	{
		$("div #tickettitle").html('My Open Tickets');
		$("div #myclosedtickets").css("display","none");
		$("div #myopentickets").css("display","block");
	}
	counter.ticketSwitchCount++;
}

function issueswitcher()
{
	var data = counter.issueSwitchCount;
	
	if((data % 2) == 1)
	{
		$("div #issuetitle").html('All Issues');
		$("div #issuesearcher").css("display","none");
		$("div #allissues").css("display","block");
	}
	else
	{
		$("div #issuetitle").html('Search Issues');
		$("div #allissues").css("display","none");
		$("div #issuesearcher").css("display","block");
	}
	counter.issueSwitchCount++;
}

$(".portlet-content").hover(function() {
	$(".imgdiv, .textdiv", this).toggle();
})



$(function() {

	$(".knob").knob({
		/*change : function (value) {
			//console.log("change : " + value);
		},
		release : function (value) {
			console.log("release : " + value);
		},
		cancel : function () {
			console.log("cancel : " + this.value);
		},*/
		draw : function () {

			// "tron" case
			if(this.$.data('skin') == 'tron') {

				var a = this.angle(this.cv)  // Angle
					, sa = this.startAngle          // Previous start angle
					, sat = this.startAngle         // Start angle
					, ea                            // Previous end angle
					, eat = sat + a                 // End angle
					, r = 1;

				this.g.lineWidth = this.lineWidth;

				this.o.cursor
					&& (sat = eat - 0.3)
					&& (eat = eat + 0.3);

				if (this.o.displayPrevious) {
					ea = this.startAngle + this.angle(this.v);
					this.o.cursor
						&& (sa = ea - 0.3)
						&& (ea = ea + 0.3);
					this.g.beginPath();
					this.g.strokeStyle = this.pColor;
					this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
					this.g.stroke();
				}

				this.g.beginPath();
				this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
				this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
				this.g.stroke();

				this.g.lineWidth = 2;
				this.g.beginPath();
				this.g.strokeStyle = this.o.fgColor;
				this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
				this.g.stroke();

				return false;
			}
		}
	});

	// Example of infinite knob, iPod click wheel
	var v, up=0,down=0,i=0
		,$idir = $("div.idir")
		,$ival = $("div.ival")
		,incr = function() { i++; $idir.show().html("+").fadeOut(); $ival.html(i); }
		,decr = function() { i--; $idir.show().html("-").fadeOut(); $ival.html(i); };
	$("input.infinite").knob(
						{
						min : 0
						, max : 20
						, stopper : false
						, change : function () {
										if(v > this.cv){
											if(up){
												decr();
												up=0;
											}else{up=1;down=0;}
										} else {
											if(v < this.cv){
												if(down){
													incr();
													down=0;
												}else{down=1;up=0;}
											}
										}
										v = this.cv;
									}
						});
});

var divElement = $('div'); //log all div elements
if (divElement.hasClass('stacked-bars-chart')) {
$(function () {

	// We need to use ajax to get these values from the database.
	$.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createAbsoluteUrl("/site/prints"); ?>',
		success:function(data){
			var yesterday = [];
			yesterday.push([1, data[1]]);

			var dayBeforeLast = [];
			dayBeforeLast.push([0, data[0]]);

			var ds = new Array();

			// The label values here will have to be set to each date.
			ds.push({
				label: "07/01/2013",
				data: yesterday
			});
			ds.push({
				label: "06/30/2013",
				data: dayBeforeLast
			});

			var stack = 0, bars = true, lines = false, steps = false;

			var options = {
					grid: {
						show: true,
						aboveData: false,
						color: "#3f3f3f" ,
						labelMargin: 5,
						axisMargin: 0, 
						borderWidth: 0,
						borderColor:null,
						minBorderMargin: 5,
						clickable: true, 
						hoverable: true,
						autoHighlight: true,
						mouseActiveRadius: 20
					},
					series: {
						grow: {active:false},
						stack: stack,
						lines: { show: lines, fill: true, steps: steps },
						bars: { show: bars, barWidth: 0.5, fill:1, barSpacing: 0.5}
					},
					xaxis: {ticks:11, tickDecimals: 0},
					legend: { 
						position: "ne", 
						margin: [0,-25], 
						noColumns: 0,
						labelBoxBorderColor: null,
						labelFormatter: function(label, series) {
							// just add some space to labes
							return label+'&nbsp;&nbsp;';
						 }
					},
					colors: chartColours,
					shadowSize:1,
					tooltip: true, //activate tooltip
					tooltipOpts: {
						content: "%s : %y.0",
						shifts: {
							x: -30,
							y: -50
						}
					}
			};

			$.plot($(".stacked-bars-chart"), ds, options);
		},
		error:function(data){ // if error occured
			alert("Error occured.please try again");
			alert(data);
		},
		dataType:'json'
	});


});
}//end if
</script>