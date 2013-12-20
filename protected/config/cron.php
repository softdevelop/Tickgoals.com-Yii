<?php
return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',
 
    'preload'=>array('log'),
 
    'import'=>array(
        'application.models.*',
		'application.components.*',
		'application.modules.*',
		'application.modules.common.models.*',
		
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
    // We'll log cron messages to the separate files
    'components'=>array(
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
            ),
        ),
 
        'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=mydomains_tickgoals',
			'emulatePrepare' => true,
			'username' => 'mydom_admin',
			'password' => 'duongquanglinh',
			'charset' => 'utf8',
		),
    ),
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'noreply@tickgoals.com'
		
	),
);
?>
