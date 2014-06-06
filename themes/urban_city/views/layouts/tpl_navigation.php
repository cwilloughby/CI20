
<div class="navbar navbar-inverse" id="templatemo_header">
	<div class="navbar-inner">
	<div class="container">

		<div id="site_title">
			<h1><a href="/site/index" target="_parent">CI2.0</a></h1>
		</div> <!-- end of site_title -->
		
		<div id="templatemo_menu">
		<?php $this->widget('zii.widgets.CMenu',array(
				'htmlOptions'=>array('class'=>'pull-right nav'),
				'submenuHtmlOptions'=>array('class'=>'dropdown-menu'),
				'encodeLabel'=>false,
				'items'=>array(
					array('label'=>'<span class="homeicon"></span>Home', 'url'=>'/site/index'),
					array(
						'label'=>'<span class="helpdeskicon"></span>Helpdesk <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest,
						'items'=>array(
							array('label'=>'Create Ticket', 'url'=>array('/tickets/troubletickets/create')),
							array('label'=>'View Open Tickets', 'url'=>array('/tickets/troubletickets/index', 'status'=>'Open')),
							array('label'=>'View Closed Tickets', 'url'=>array('/tickets/troubletickets/index', 'status'=>'Closed')),
							array('label'=>'Training Resources', 'url'=>array('/training/training/typeindex')),
							array('label'=>'Human Resources', 'url'=>array('/hr/hrpolicy/index')),
						),
					),
					array(
						'label'=>'<span class="cjisicon"></span>CJIS <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest,
						'items'=>array(
							array('label'=>'Search Documents', 'url'=>array('/cjisucflist/doctable/searchableFileTable')),
							//array('label'=>'Upload CJIS File', 'url'=>array('/cjisucflist/doctable/createFileRecord'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							//array('label'=>'CJIS Dispositions', 'url'=>array('/cjisdispositions/cjisdispositions/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						),
					),
					/*
					array(
						'label'=>'<span class="evidenceicon"></span>Evidence <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id)),
						'items'=>array(
							array('label'=>'Search Case Files', 'url'=>array('/evidence/casesummary/admin'), 'visible'=>Yii::app()->user->checkAccess('EvidenceView', Yii::app()->user->id)),
							array('label'=>'Create Case File', 'url'=>array('/evidence/casesummary/create'),'visible'=>Yii::app()->user->checkAccess('EvidenceAdmin', Yii::app()->user->id)),
							array('label'=>'Advanced Tools', 'url'=>array('/evidence/casesummary/evidencemanager'), 'visible'=>Yii::app()->user->checkAccess('EvidenceAdmin', Yii::app()->user->id)),
						),
					),
					*/
					array(
						'label'=>'<span class="adminicon"></span>Admin Tools <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest && (Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)
							|| Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						'items'=>array(
							array('label'=>'News Management', 'url'=>array('/news/news/index'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
							//array('label'=>'CJIS Issue Tracker', 'url'=>array('/issuetracker/issuetracker/admin'), 'visible'=>Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
						),
					),
					array(
						'label'=>'<span class="ITicon"></span>IT Tools <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id),
						'items'=>array(
							array('label'=>'Manage Users', 'url'=>array('/security/userinfo/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							//array('label'=>'Comment Manager', 'url'=>array('/tickets/comments/index'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							//array('label'=>'Log Controls', 'url'=>array('/security/log/admin'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							array('label'=>'Modify User Privileges', 'url'=>array('/srbac'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
							array('label'=>'Centriod', 'url'=>array('/centriod/centriod/examinefiles'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						),
					),
					array(
						'label'=>'<span class="timeicon"></span>Time Log <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest && (/*Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)*/
							Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
							|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id)),
						'items'=>array(
							array('label'=>'Time Log', 'url'=>array('/timelog/timelog/admin'), 'visible'=>Yii::app()->user->checkAccess('Admin', Yii::app()->user->id)),
							array('label'=>'GS Time Log', 'url'=>array('/timelog/gstimelog/admin'), 'visible'=>(Yii::app()->user->checkAccess('IT', Yii::app()->user->id)
								|| Yii::app()->user->checkAccess('ExternalGS', Yii::app()->user->id))),
						),
					),
					array(
						'label'=>'<span class="evaluationicon"></span>Evaluations <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest,
						'items'=>array(
							array('label'=>'Evaluations', 'url'=>array('/evaluations/evaluations/index'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Evaluation Questions', 'url'=>array('/evaluations/evaluationquestions/index'), 'visible'=>Yii::app()->user->checkAccess('Supervisor', Yii::app()->user->id)),
						),
					),
					array(
						'label'=>'<span class="linksicon"></span>Links <span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id),
						'items'=>array(
							array('label'=>'Printers & Copiers', 'url'=>array('/links/links/printersCopiers'), 'visible'=>Yii::app()->user->checkAccess('IT', Yii::app()->user->id)),
						),
					),
					array(
						'label'=>'<span class="usericon"></span>' . Yii::app()->user->name . '<span class="caret"></span>', 'url'=>'#','itemOptions'=>array('class'=>'dropdown','tabindex'=>"-1"),'linkOptions'=>array('class'=>'dropdown-toggle','data-toggle'=>"dropdown"),
						'visible'=>!Yii::app()->user->isGuest,
						'items'=>array(
							array('label'=>'Logout', 'url'=>array('/security/login/logout')),
							array('label'=>'Change Password', 'url'=>array('/security/password/changePassword')),
						),
					),
				)
			)); ?>
		</div>
	</div>
</div>
</div>
