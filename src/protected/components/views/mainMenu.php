<ul id="nav">
<?php foreach($items as $item): ?>
	<li><?php echo CHtml::link($item['label'],$item['url'], $item['active'] ? array('class'=>'active') : array()); ?></li>
<?php endforeach; ?>
<?php if(!Yii::app()->user->isGuest): ?>
	<li>Logged in as <?php echo Yii::app()->user->name ?> (<?php echo CHtml::link('Logout', array('logout/')) ?>)</li>
<?php endif; ?>
</ul>
