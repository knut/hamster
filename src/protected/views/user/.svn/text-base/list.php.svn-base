<h1><?php echo Yii::t('messages', 'Users') ?></h1>

<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
<br/>
<br/>
<table border="0" cellspacing="0" cellpadding="0" class="wide forums">
	<tr>
		<th class="la" width="88%"><?php echo Yii::t('messages', 'Name') ?> / <?php echo Yii::t('messages', 'Login') ?></th>
		<th><?php echo Yii::t('messages', 'Website') ?></th>
		<th width="1%"><?php echo Yii::t('messages', 'Posts') ?></th>
	</tr>
	<?php foreach($usersList as $n => $user): ?>
	<tr>
		<td><?php echo CHtml::link($user->name, array('view', 'id' => $user->id)); ?></td>
		<td><?php echo CHtml::encode($user->website); ?></td>
		<td><?php echo CHtml::encode($user->posts_count); ?></td>
	</tr>
	<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
