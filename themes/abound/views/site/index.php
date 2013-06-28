<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$baseUrl = Yii::app()->theme->baseUrl; 
?>

<div class="row-fluid">
	<div class="span3 portlet_border">
		<?php
		if(!isset(Yii::app()->user->id))
			$this->widget('UserLogin');
		else
		{
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon-th-list"></span> Last Login',
				'titleCssClass'=>''
			));
			?>
			<div id="img1" onmouseenter='myOutAnimater(img1, timeReport);'>
				<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/css/black.png'>"; ?>
			</div>
			<div id="timeReport" onmouseleave='myInAnimater(img1, timeReport);'>
				<?php $this->widget('TimeReport'); ?>
			</div>
			<?php
			$this->endWidget();
			
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'<span class="icon-th-list"></span> 12 Hour Forcast',
				'titleCssClass'=>''
			));
			?>
			<div id="img2" onmouseover='myOutAnimater(img2, weatherReport);'>
				<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/css/black.png'>"; ?>
			</div>
			<div id="weatherReport" onmouseout='myInAnimater(img2, weatherReport);'>
				<?php $this->widget('WeatherReport'); ?>
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
	<div class="span3 portlet_border">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-list"></span> Criminal Court Clerk News',
			'titleCssClass'=>''
		));?>
		<div id="img3" onmouseover='myOutAnimater(img3, mainNews);'>
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/css/black.png'>"; ?>
		</div>
		<div id="mainNews" onmouseout='myInAnimater(img3, mainNews);'>
			<?php $this->widget('NewsReport');?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<div class="sidebar-nav">
			<div id="img4" onmouseover='myOutAnimater(img4, quickMenu);'>
				<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/css/black.png'>"; ?>
			</div>
			<div id="quickMenu" onmouseout='myInAnimater(img4, quickMenu);'>
				<?php $this->widget('zii.widgets.CMenu', array(
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
				?>
			</div>
		</div>
	</div>
	<div class="span3 portlet_border">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-list"></span> IT News',
			'titleCssClass'=>''
		));
		$this->widget('NewsReport', array('type'=>'IT News'));
		$this->endWidget();
		?>
	</div>
	<div class="span3 portlet_border">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-list"></span> IT News',
			'titleCssClass'=>''
		));?>
		<div id="img5" onmouseover='myOutAnimater(img5, itNews);'>
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/css/black.png'>"; ?>
		</div>
		<div id="itNews" onmouseout='myInAnimater(img5, itNews);'>
			<?php $this->widget('NewsReport', array('type'=>'IT News'));?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
	<div class="span3 portlet_border">
		<?php 
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-list"></span> Training Resources',
			'titleCssClass'=>''
		));?>
		<div id="img6" onmouseover='myOutAnimater(img6, train);'>
			<?php echo "<img src='" . Yii::app()->theme->baseUrl . "/css/black.png'>"; ?>
		</div>
		<div id="train" onmouseout='myInAnimater(img6, train);'>
			<?php $this->widget('Training');?>
		</div>
		<?php $this->endWidget(); ?> 
	</div>
</div>
<div class="row-fluid">

	<div class="span4 portlet_border">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-picture"></span><span id="tickettitle">My Open Tickets</span><img class="switcher icon-retweet"  style="float:right" onclick="ticketswitcher();"></img>',
			'titleCssClass'=>''
		));
		?>
		<div id="myopentickets">
			<?php $this->widget('MyTickets');?>
        </div>
		<div id="createticket">
			<?php $this->widget('CreateTicketWid'); ?>
        </div>
		<div id="myclosedtickets">
			<?php $this->widget('MyTickets', array('status'=>'Closed'));?>
        </div>
        <?php $this->endWidget(); ?>
        
	</div>
	<div class="span4 portlet_border">
	  <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-large"></span>Income Chart',
			'titleCssClass'=>''
		));
		?>
        
        <div class="visitors-chart" style="height: 230px;width:100%;margin-top:15px; margin-bottom:15px;"></div>
        
        <?php $this->endWidget(); ?>
	</div><!--/span-->
	<div class="span4 portlet_border">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=>'<span class="icon-th-list"></span><span id="issuetitle">Search Issues</span><img class="switcher icon-retweet" style="float:right" onclick="issueswitcher();"></img>',
			'titleCssClass'=>''
		));
		?>
        <div id="issuesearcher">
			<?php $this->widget('IssueSearcher');?>
        </div>
		<div id="allissues">
			<?php $this->widget('IssueSearcher', array('type'=>'All'));?>
        </div>
        <?php $this->endWidget(); ?>
	</div>
</div>

<div class="row-fluid">
    </div>
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

function myOutAnimater(imgid, portletid)
{
	$(imgid).stop(true).css("display","none");
	$(portletid).stop(true).css("display","block");
}

function myInAnimater(imgid, portletid)
{
	$(portletid).stop(true).css("display","none");
	$(imgid).stop(true).css("display","block");
}

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
        </script>