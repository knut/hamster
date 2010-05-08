<h1><?php echo Yii::t('messages', 'Recent Posts') ?></h1>

<?php $this->widget('CLinkPager', array(
	'pages' => $pages,
	'header' => Yii::t('messages', 'Go to page:'),
	'prevPageLabel' => Yii::t('messages', '< Previous'),
	'nextPageLabel' => Yii::t('messages', 'Next >'),
)); ?>
<br/>
<br/>
<table border="0" cellspacing="0" cellpadding="0" class="posts wide">
<?php foreach($postsList as $post): ?>
	<tr class="post hentry" id="posts-<?php echo $post->id ?>">
	  <td class="author vcard">
	    <div class="date">
	      <abbr class="updated" title="<?php echo date_format(date_create($post->created_at), DateTime::ISO8601) ?>">
	      	<?php echo Yii::app()->dateFormatter->formatDateTime($post->created_at, 'medium', 'short') ?>
	      </abbr>
	    </div>
	    <img alt="<?php echo $post->author->name ?>" class="photo" height="32" src="http://www.gravatar.com/avatar/<?php echo md5($post->author->email) ?>.jpg&amp;rating=PG&amp;size=32" width="32" />
	    <span class="fn"><?php echo CHtml::link($post->author->name, array('user/view', 'id' => $post->author->id)) ?></span>
	    <span class="posts"><?php echo $post->author->posts_count; ?> <?php echo Yii::t('messages', '1#post|n>1#posts', array($post->author->posts_count)); ?></span>
	  </td>
	  <td class="body entry-content">
	    <p class="topic">
	      <?php echo Yii::t('messages', 'Topic') ?>: <?php echo CHtml::link($post->forum->name, array('forum/view', 'id' => $post->forum->id)) ?> / 
			<?php echo CHtml::link($post->topic->title, array('topic/view', 'id' => $post->topic->id)) ?>
	    </p>
		<?php echo $post->getBodyHtml() ?>
	  </td>
	</tr>
	
	<tr class="spacer">
	  <td colspan="2">&nbsp;</td>
	</tr>

<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager', array(
	'pages' => $pages,
	'header' => Yii::t('messages', 'Go to page:'),
	'prevPageLabel' => Yii::t('messages', '< Previous'),
	'nextPageLabel' => Yii::t('messages', 'Next >'),
)); ?>