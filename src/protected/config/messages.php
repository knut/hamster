<?php
/**
 * This file is used as configuration for the message command of yiic.
 * 
 * Update translation files with:
 *   
 *  $ ./yiic message config/messages.php
 *
 */
return array(
	'sourcePath' => dirname(__FILE__).'/../',
	'messagePath' => dirname(__FILE__).'/../messages/',
	'languages' => array('en_US', 'nb_NO', 'nn_NO'),
	'fileTypes' => array('php'),
	'exclude' => array('.svn', '/lib', '/runtime', '/tests', '/config', '/messages'),
	'translator' => 'Yii::t',
);
