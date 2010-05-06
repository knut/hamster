<div class="crumbs">
  &laquo; <?php echo CHtml::link(Yii::t('messages', 'Home'), array('/')) ?>
</div>

<h1><?php echo $forum->name; ?></h1>
<p><?php echo CHtml::encode($forum->description); ?></p>

<table border="0" cellspacing="0" cellpadding="0" class="wide topics">
	<tr>
		<th class="la" colspan="2"><?php echo Yii::t('messages', 'Topic') ?></th>
		<th width="1%"><?php echo Yii::t('messages', 'Posts') ?></th>
		<th width="1%"><?php echo Yii::t('messages', 'Views') ?></th>
		<th class="la"><?php echo Yii::t('messages', 'Last post') ?></th>
	</tr>

<?php //var_dump('<pre>', $topics) ?>

<?php foreach($forum->topics as $topic): ?>
	<tr class="hentry">
		<td style="padding:5px; width:16px;" class="c1">
			<!--<img alt="Comment" class="icon green" src="<?php echo Yii::app()->request->baseUrl; ?>/images/comment.gif" title="Recent activity" />-->
			<img alt="<?php echo Yii::t('messages', 'Comment') ?>" class="icon grey" src="<?php echo Yii::app()->request->baseUrl; ?>/images/comment.gif" title="<?php echo Yii::t('messages', 'No recent activity') ?>" />
		</td>
		<td class="c2">
			
			<?php if($topic->sticky): ?>
				Sticky: <strong>
			<?php endif; ?>
			<?php echo CHtml::link($topic->title, array('topic/view', 'id' => $topic->id), array('class' => 'entry-title', 'rel' => 'bookmark')); ?>
			<?php if($topic->sticky): ?>
				</strong>
			<?php endif; ?>
			<?php if($topic->last_post): ?>
				<small><?php echo CHtml::link('last', array('topic/view', 'id' => $topic->last_post->id)) ?></small>
			<?php endif; ?>
		</td>
		<td class="ca stat"><?php echo $topic->posts_count ?></td>
		<td class="ca stat"><?php echo $topic->hits ?></td>
		<td class="lp">
			<abbr class="updated" title="<?php echo date_format(date_create($topic->created_at), DateTime::ISO8601) ?>">
				<?php echo CHtml::link(Yii::app()->dateFormatter->formatDateTime($topic->created_at, 'medium', 'short'), array('topic/view', 'id' => $topic->id)) ?>
			</abbr>
			<?php if($topic->last_post): ?>
				<?php echo Yii::t('messages', 'by') ?> <?php echo CHtml::link($topic->last_post->author->name, array('user/view', 'id' => $topic->last_post->author->id)) ?>
			<?php endif; ?>
		</td>
	</tr>
<?php endforeach; ?>

</table>
