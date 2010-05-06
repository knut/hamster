<div class="sidebar_welcome">
	<h2>Welcome!</h2>
    <p>You have successfully installed the Hamster Forum. You should edit <code>protected/views/sidebar/welcome.php</code> to change this welcome message for your forum users.</p>

    <h2>The ground rules</h2>
    <p>Be civil, reasonable, and helpful.</p>
</div>

<p class="feed">
	<a href="<?php echo CHtml::normalizeUrl(array('posts/feed')) ?>"><img alt="Subscribe to Recent Posts" height="14" src="<?php echo Yii::app()->request->baseUrl; ?>/images/feed-icon.png" width="14" /></a>
	<?php echo CHtml::link(CHtml::encode(Yii::app()->params['title'])." Feed", array('posts/feed')); ?>
</p>