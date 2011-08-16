<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'name' => 'My Forum',	
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'sourceLanguage' => 'en',
	'language' => 'nb_NO',
	'defaultController' => 'site',
	
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
	),
	
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params' => require(dirname(__FILE__).'/params.php'),

	// application components
	'components'=>array(
		'assetManager' => array(
			'class' => 'CAssetManager',
		),
		'authManager' => array(
			'class' => 'CPhpAuthManager',
		),
		'db' => array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/hamster.db',
			//'connectionString' => 'mysql:host=localhost;dbname=hamster',
			'username' => '',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling' => true,
		),
		// uncomment the following to use a MySQL database
		/*
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=testdrive',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		),
		*/
		'cache' => array(
			'class' => 'CDummyCache',
		),
		'clientScript' => array(
			'class' => 'CClientScript',
		),
		'coreMessages' => array(
			'class' => 'CPhpMessageSource',
		),
		'errorHandler' => array( // handles uncaught PHP errors and exceptions
			'class' => 'CErrorHandler',
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class' => 'CProfileLogRoute',
					'report' => 'summary', // execution time summary, slowest on top (default)
					//'report' => 'callstack', // reflecting the calling sequence
				),
				array(
					'class'=>'CWebLogRoute',
				),
			),
		),
		'messages' => array( // provides translated messages used by Yii application
			'class' => 'CPhpMessageSource',
		),
		'request' => array( // provides information related to user request
			'class' => 'CHttpRequest',
		),
		'session' => array(
			'class' => 'CHttpSession',
		),
		'statePersister' => array(
			'class' => 'CStatePersister',
		),
		'themeManager' => array(
			'class' => 'CThemeManager',
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'urlManager' => array(
			'urlFormat' => 'path',
			'showScriptName' => false,
			'rules' => require(dirname(__FILE__).'/rules.php'),
		),
	),	
);