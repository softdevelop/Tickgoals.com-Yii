<?php
define('CONSUMER_KEY', 'AUAP1obVNiOG8ezsG0FE9g');
define('CONSUMER_SECRET', 'xG2GwtX4YDbz3iXwCf4ysQJhpIGVLchrAX4z0Mqsw');
define('OAUTH_CALLBACK', 'http://tickgoals.com');

require("function_alias.php");
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
$strJLPath = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'components' ;

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
Yii::setPathOfAlias('widgets',$strJLPath.DIRECTORY_SEPARATOR.'widgets');
// Yii::setPathOfAlias('utils',$strJLPath.DIRECTORY_SEPARATOR.'utils');
Yii::setPathOfAlias('bootstrap', dirname(__FILE__) . "/../extensions/bootstrap");
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log','twitterconnect','translate'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.modules.*',
		'application.modules.common.models.*',
		'application.modules.translate.TranslateModule',
		
		'application.modules.social.components.*',
		'application.modules.user.components.*',
		'application.modules.user.models.*',
		'application.modules.user.models.Users',
		
		'application.modules.admin.*',
		'application.modules.admin.models.*',
		
		'application.modules.rights.*',
		'application.modules.rights.components.*',
		
		'application.modules.new.models.*',
		
		'application.modules.departments.models.*',
		'application.modules.settings.models.*',
		
		
		
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
        'translate',
        'user',
        'rights',
        'common',
		'settings',
		'social',
		'departments',
		'admin',
		'gii'=>array(
			'class' => 'system.gii.GiiModule',
			'password' => 'qthinh',
			'generatorPaths' => array(
				'ext.bootstrap.gii', 
				'ext.gtc' // a path alias
			),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters' => array('127.0.0.1', '::1'),
		),
		
		
	),
	'language'=> 'en',
	// application components
	'components'=>array(
		'messages' => array(
			'class' => 'CDbMessageSource',
			'onMissingTranslation' => array('Ei18n', 'missingTranslation'),
			'sourceMessageTable' => 'tbl_source_message',
			'translatedMessageTable' => 'tbl_message'
		),
		'translate' => array(
			'class' => 'translate.components.Ei18n',
			'createTranslationTables' => true,
			'connectionID' => 'db',
			'languages' => array(
				'en' => 'en',
				'es' => 'Español',
				'it' => 'Italiano'
			)
		),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array( // You can change the providers and their classes.
                
                'twitter' => array(
                    // register your app here: https://dev.twitter.com/apps/new
                    'class' => 'TwitterOAuthService',
                    'key' => 'AUAP1obVNiOG8ezsG0FE9g',
                    'secret' => 'xG2GwtX4YDbz3iXwCf4ysQJhpIGVLchrAX4z0Mqsw',
                ),
                
            ),
        ),
		'twitterconnect' => array(
            'class' => 'ext.twitterconnect.TwitterConnect',
            'consumerKey' => 'AUAP1obVNiOG8ezsG0FE9g',
            'consumerSecret' => 'xG2GwtX4YDbz3iXwCf4ysQJhpIGVLchrAX4z0Mqsw',
            'twitterRequestUrl' => 'https://api.twitter.com/oauth/request_token',
            'twitterAccessUrl' => 'https://api.twitter.com/oauth/access_token',
            'twitterAutorizeUrl' => 'https://api.twitter.com/oauth/authorize' 
        ),
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
		
		'mail' => array(
			'class' => 'ext.yii-mail.YiiMail',
			'transportType' => 'smtp',
			'transportOptions' => array(
				'host'=>'smtp.gmail.com',
				'username'=>'noreplytickgoals@gmail.com',
				'password'=>'noreplytickgoals123',
				'port'=>'465',
				'encryption'=>'tls'
			),
			'viewPath' => 'application.views.mail',
			'logging' => true,
			'dryRun' => false
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			// 'class'=>'CWebUser',
			'loginUrl'=>array('/'),
		),
		// uncomment the following to enable URLs in path-format

		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules' => array(				
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			)
		),
		
		// 'db'=>array(
			// 'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		// ),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=tickgoals',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		// 'authManager'=>array( 
			// 'class'=>'RDbAuthManager',

		// ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		'cache'=>array(
            'class'=>'system.caching.CFileCache',
        ),
		'settings'=>array(
			'class'=> 'ext.CmsSettings',
			'cacheComponentId'  => 'cache',
			'cacheId'           => 'global_website_settings',
			'cacheTime'         => 84000,
			'tableName'     => '{{settings}}',
			'dbComponentId'     => 'db',
			'createTable'       => true,
			'dbEngine'      => 'InnoDB',
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'reminder@tickgoals.com'
		
	),
);