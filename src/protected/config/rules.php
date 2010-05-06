<?php
/**
 * A list of url rules to be used by the url manager.
 *
 * Format: pattern => route 
 *
 * @see http://www.yiiframework.com/doc/api/CUrlRule
 * @see http://www.yiiframework.com/doc/api/CUrlManager#rules-detail
 */
return array(
	'/' => 'forum/',
	'rss.xml' => 'post/feed',
	'signup' => 'user/create',
	'settings' => 'user/edit',
	'login' => 'site/login',
	'logout' => 'site/logout',
	'user' => 'user/list',
	'user/<id:\d+>' => 'user/view',
	'forum/<id:\d+>' => 'forum/view',
	'topic/<id:\d+>' => 'topic/view',
	'topic/new' => 'topic/create',
	'post' => 'post/list',
	'forum/<id:\d+>/topic/new' => 'topic/create',
);
