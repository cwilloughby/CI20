<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'CI2.0',
	'theme'=>'abound',
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.security.models.*',
		'application.modules.security.components.*',
		'application.extensions.phpmailer.JPhpMailer',
		'application.extensions.jqrelcopy.JQRelcopy',
		'application.extensions.smp.StrobeMediaPlayback',
		'application.extensions.dropzone.EDropzone',
		'application.extensions.filetree.SFileTree',
		'application.extensions.yexcel.Yexcel',
		'application.modules.srbac.controllers.SBaseController',
		'application.modules.srbac.models.Assignments',
		'application.modules.email.controllers.*',
		'application.modules.tickets.models.*',
		'application.modules.documentprocessor.models.*',
		'application.modules.news.models.*',
		'application.modules.weather.models.*',
		'application.modules.videos.models.*',
		'application.modules.issuetracker.models.*',
		'application.modules.training.components.*',
		'application.modules.documentprocessor.components.*',
		'application.widgets.*',
		'zii.widgets.CPortlet'
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'giicool',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'security',
		'email',
		'tickets',
		'hr',
		'documentprocessor',
		'news',
		'evidence',
		'timelog',
		'weather',
		'centriod',
		'links',
		'evaluations',
		'videos',
		'training',
		'issuetracker',
		'srbac'=>array(
			'userclass'=>'UserInfo', //default: User
			'userid'=>'userid', //default: userid
			'username'=>'username', //default:username
			'delimeter'=>'@', //default:-
			'debug'=>false, //default :false
			'pageSize'=>20, // default : 15
			'superUser'=>'IT', //default: Authorizer
			'css'=>'srbac.css', //default: srbac.css
			//default: application.views.layouts.main, must be an existing alias
			'layout'=>'webroot.themes.abound.views.layouts.main', 
			//default: srbac.views.authitem.unauthorized, must be an existing alias
			'notAuthorizedView'=>'srbac.views.authitem.unauthorized', 
			'alwaysAllowed'=>array( //default: array()
				'SiteIndex', 'SiteAdmin', 'SiteError'
			),
			'userActions'=>array('Show', 'View', 'List'), //default: array()
			'listBoxNumberOfLines'=>15, //default : 10
			'imagesPath'=>'srbac.images', // default: srbac.images
			'imagesPack'=>'noia', //default: noia
			'iconText'=>true, //default: false
			'header'=>'srbac.views.authitem.header', //default: srbac.views.authitem.header, must be an existing alias
			'footer'=>'srbac.views.authitem.footer', //default: srbac.views.authitem.footer, must be an existing alias
			'showHeader'=>true, // default: false
			'showFooter'=>true, // default: false
			'alwaysAllowedPath'=>'srbac.components', //default: srbac.components, must be an existing alias
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			'class' => 'CWebUser',
			'autoUpdateFlash' => false,
			'allowAutoLogin'=>false,
			'loginUrl'=>array('/security/login/login'),
		),
		// uncomment the following to enable URLs in path-format
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'caseSensitive'=>false,
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
			),
		),
		'cache'=>array(
			//'class'=>'system.caching.CApcCache',
			'class'=>'system.caching.CDbCache'
		),
		'db'=>array(
			'class'=>'CDbConnection',
			'connectionString' => 'mysql:host=localhost;dbname=ci2',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'schemaCachingDuration'=>3600,
		),
		'authManager'=>array(
			'class'=>'application.modules.srbac.components.SDbAuthManager',
			'connectionID'=>'db',
			'itemTable'=>'ci_auth_items',
			'assignmentTable'=>'ci_auth_assignments',
			'itemChildTable'=>'ci_auth_item_children',
		),
		'ePdf' => array(
			'class' => 'application.extensions.yii-pdf.EYiiPdf',
			'params' => array(
				'HTML2PDF' => array(
					'librarySourcePath' => 'application.vendors.html2pdf.*',
					'classFile' => 'html2pdf.class.php', // For adding to Yii::$classMap
				)
			)
		),
		'yexcel' => array(
			'class' => 'application.extensions.yexcel.Yexcel'
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'ccc.helpdesk@nashville.gov',
	),
);
