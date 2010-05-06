<h1><?php echo $user->name ?></h1>

<p style="float: right;"><img alt="Avatar" class="photo" height="80" src="http://www.gravatar.com/avatar/<?php echo md5($user->email) ?>.jpg&amp;rating=PG&amp;size=80" width="80" /></p> 

<p class="subtitle">
  <a href="/users/506/posts.rss"><img alt="Subscribe to <?php echo $user->name ?>" height="14" src="<?php echo Yii::app()->request->baseUrl; ?>/images/feed-icon.png?1217504846" width="14" /></a>
  <span>
	<?php echo $user->topics_count ?> <?php echo Yii::t('messages', 'topics') ?>,
	<?php echo $user->posts_count ?> <?php echo Yii::t('messages', 'posts') ?> (view all)
	
	
    <!--5 emne(r), 
    66 innlegg
    (vis <a href="/users/506/posts">alle</a> | 
    <a href="/users/506/monitored">overvåket</a> innlegg)<br />
	-->
	
  </span>
</p>

<?php echo $user->bio_html ?>

<?php if($user->website): ?>
<p><strong><?php echo Yii::t('messages', 'Website') ?></strong> <?php echo CHtml::link($user->website, $user->website) ?>
<?php endif; ?>

<p><?php echo Yii::t('messages', 'Member since') ?> <?php echo Yii::app()->dateFormatter->formatDateTime($user->created_at, 'long', null) ?></p>

<?php if($user->topics): ?>
	<h2><?php echo Yii::t('messages', 'Latest topics') ?></h2>
	<p>
	<?php foreach($user->topics as $topic): ?>
		<?php echo Yii::app()->dateFormatter->formatDateTime($topic->created_at, 'long', null) ?> - <?php echo CHtml::link($topic->title, array('/topic/view', 'id' => $topic->id)) ?><br/>
	<?php endforeach; ?>
	</p>
<?php endif; ?>

