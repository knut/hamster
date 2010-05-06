<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<title><?php echo $this->pageTitle; ?></title>
	<?php Yii::app()->clientScript->registerCoreScript('jquery') ?>
	<?php Yii::app()->clientScript->registerLinkTag('alternate', 'application/rss+xml', $this->createUrl('posts/feed'), 'screen', array('title' => Yii::app()->params['title']." - Latest posts")); ?>
	
	<?php //if($this->beginCache('scripts')): ?>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/prototype.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/effects.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/lowpro.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/application.js"></script>
	<?php //$this->endCache(); endif; ?>
	
</head>
<body>	
<div id="container">
	
	<div id="header">

		<?php $this->widget('MainMenu', array(
			'items' => array(
				array('label' => Yii::t('messages', 'Home'), 'url' => array('/')),
				array('label' => Yii::t('messages', 'Recent posts'), 'url' => array('post/list')),
				//array('label' => Yii::t('messages', 'Search'), 'url' => array('/')),
				array('label' => Yii::t('messages', 'Users'), 'url' => array('/user/list')),
				array('label' => Yii::t('messages', 'Signup'), 'url' => array('/signup'), 'visible' => Yii::app()->user->isGuest),
				array('label' => Yii::t('messages', 'Login'), 'url' => array('/site/login'), 'visible' => Yii::app()->user->isGuest),
			),
		)); ?>

<!--<ul id="nav">
	    	<li id="search">
	      	<% form_tag search_all_posts_path, :method => 'get' do -%>
	        	<%= text_field_tag :q, params[:q], :size => 15, :id => :search_box %>
	      		<% end -%>
	    	</li>
	    	<li><%= link_to_function 'Search'[:search_title], "$('search').toggle(); $('search_box').focus();", :href => home_path %></li>

	  	</ul>-->
	  
		<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
	</div>

	<div id="content">
		<?php echo $content; ?>
	</div>

	<div id="right">
		<div class="inner">
		<?php
		if($this->id == "forums" && $this->action->id == "list") {
			$this->renderPartial('/sidebar/welcome');
		}
		?>


	<p class="feed">
  		<a href="<?php echo CHtml::normalizeUrl(array('post/feed')) ?>"><img alt="<?php echo Yii::t('messages', 'Subscribe to') ?> <?php echo Yii::app()->params['title'] ?>" height="14" src="<?php echo Yii::app()->request->baseUrl; ?>/images/feed-icon.png" width="14" /></a>
  		<a href="<?php echo CHtml::normalizeUrl(array('post/feed')) ?>"><?php echo Yii::t('messages', 'Feed for this forum') ?></a>
	</p>

	<?php if(Yii::app()->user->isGuest): ?>
	<p class="post_new"><strong><a href="<?php echo CHtml::normalizeUrl(array('/signup')) ?>" class="admin"><?php echo Yii::t('messages', 'Signup') ?></a></strong> <?php echo Yii::t('messages', 'or') ?> <strong><a href="<?php echo CHtml::normalizeUrl(array('/login')) ?>" class="admin"><?php echo Yii::t('messages', 'login') ?></a></strong> <?php echo Yii::t('messages', 'to post a topic') ?>.</p>
	<?php endif; ?>

	</div>
</div>

<br style="clear:both;" />

<?php //if($this->beginCache('footer')): ?>
<div id="footer">
	<p class="credit">	
		<?php echo Yii::app()->params['copyrightInfo'] ?><br/>
		<?php echo Yii::powered(); ?>
	</p>
</div>
<?php //$this->endCache(); endif; ?>

</div>
</body>
</html>
