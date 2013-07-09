<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
          <a class="brand" href='<?php echo Yii::app()->baseUrl ;?>'>CI2.0</a>
          
          <div class="nav-collapse">
			<?php $this->widget('zii.widgets.CMenu',array(
                    'htmlOptions'=>array('class'=>'pull-right nav'),
                    'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
					'itemCssClass'=>'item-test',
                    'encodeLabel'=>false,
					'items'=>array(
						array('label'=>'Home', 'url'=>array(Yii::app()->baseUrl), 'itemOptions'=>array('class'=>'menu-icon-home')),
						array(
							'label'=>'Helpdesk <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>!Yii::app()->user->isGuest,
							'items'=>array(
								array('label'=>'<i class="icon icon-tag"></i> Create Ticket', 'url'=>array('/tickets/troubletickets/create')),
								array('label'=>'<i class="icon icon-eye-open"></i> View Open Tickets', 'url'=>array('/tickets/troubletickets/index')),
								array('label'=>'<i class="icon icon-eye-close"></i> View Closed Tickets', 'url'=>array('/tickets/troubletickets/closedindex')),
								array('label'=>'<i class="icon icon-book"></i> Training Resources', 'url'=>array('/training/training/typeindex')),
							),
						),
						array(
							'label'=>'Evidence <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id)),
							'items'=>array(
								array('label'=>'<i class="icon icon-search"></i> Search Case Files', 'url'=>array('/evidence/casesummary/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-edit"></i> Create Case File', 'url'=>array('/evidence/casesummary/create'),'visible'=>Yii::app()->user->checkAccess('EvidenceAdmin', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-briefcase"></i> Advanced Tools', 'url'=>array('/evidence/casesummary/evidencemanager'), 'visible'=>Yii::app()->user->checkAccess('EvidenceAdmin', Yii::app()->user->id)),
							),
						),
						array(
							'label'=>'Admin Tools <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)
								|| Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							'items'=>array(
								array('label'=>'<i class="icon icon-bullhorn"></i> News Management', 'url'=>array('/news/news/index'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-map-marker"></i> CJIS Issue Tracker', 'url'=>array('/issuetracker/issuetracker/admin'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
							),
						),
						array(
							'label'=>'IT Tools <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id),
							'items'=>array(
								array('label'=>'<i class="icon icon-user"></i> Manage Users', 'url'=>array('/security/userinfo/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-comment"></i> Comment Manager', 'url'=>array('/tickets/comments/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-list-alt"></i> Log Controls', 'url'=>array('/security/log/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-lock"></i> Modify User Privileges', 'url'=>array('/srbac'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-warning-sign"></i> Centriod', 'url'=>array('/centriod/centriod/examinefiles'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-film"></i> Upload Training Resources', 'url'=>array('/videos/videos/create'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							),
						),
						array(
							'label'=>'Time Log <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)
								|| Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
								|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id)),
							'items'=>array(
								array('label'=>'<i class="icon icon-time"></i> Time Log', 'url'=>array('/timelog/timelog/admin'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
								array('label'=>'<i class="icon icon-facetime-video"></i> GS Time Log', 'url'=>array('/timelog/gstimelog/admin'), 'visible'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
									|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id))),
							),
						),
						array(
							'label'=>'Evaluations <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>!Yii::app()->user->isGuest,
							'items'=>array(
								array('label'=>'<i class="icon icon-pencil"></i> Evaluations', 'url'=>array('/evaluations/evaluations/index'), 'visible'=>!Yii::app()->user->isGuest),
								array('label'=>'<i class="icon icon-question-sign"></i> Evaluation Questions', 'url'=>array('/evaluations/evaluationquestions/index'), 'visible'=>Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
							),
						),
						array(
							'label'=>'Links <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id),
							'items'=>array(
								array('label'=>'<i class="icon icon-print"></i> Printers & Copiers', 'url'=>array('/links/links/printersCopiers'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							),
						),
						array(
							'label'=>Yii::app()->user->name . '<span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
							'visible'=>!Yii::app()->user->isGuest,
							'items'=>array(
								array('label'=>'<i class="icon icon-off"></i> Logout', 'url'=>array('/security/login/logout')),
								array('label'=>'<i class="icon icon-lock"></i> Change Password', 'url'=>array('/security/password/change')),
							),
						),
					)
                )); ?>
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        
        	<div class="style-switcher pull-left">
                <a href="#" onclick="switcher('/css/style-blue.css');"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="#" onclick="switcher('/css/style-brown.css');"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="#" onclick="switcher('/css/style-green.css');"><span class="style" style="background-color:#468847;"></span></a>
                <a href="#" onclick="switcher('/css/style-grey.css');"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="#" onclick="switcher('/css/style-orange.css');"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="#" onclick="switcher('/css/style-purple.css');"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="#" onclick="switcher('/css/style-red.css');"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <!-- <input type="text" class="search-query span2" placeholder="Search">-->
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->

<script type="text/javascript">
function switcher(style)
{	
	$.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createAbsoluteUrl("site/color"); ?>',
		data: {style: style},
		success:function(data){
			$("#mystyle").attr("href", data);
		},
		error:function(data){ // if error occured
			alert("Error occured.please try again");
			alert(data);
		},
		dataType:'html'
	});
}
</script>