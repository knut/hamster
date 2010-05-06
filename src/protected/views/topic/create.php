<div class="crumbs" xstyle="margin-top: 1.1em;">
	<?php echo CHtml::link('Forums', array('/')) ?> <span class="arrow">&rarr;</span>
	<?php echo CHtml::link($forum->name, array('forums/show', 'id' => $forum->id)) ?> <span class="arrow">&rarr;</span>
</div>

<h1>New Topic</h1>
<p class="subtitle">by <?php echo Yii::app()->user->name ?></p>

<!--<div class="actionBar">
[<?php echo CHtml::link('Topics List',array('list')); ?>]
[<?php echo CHtml::link('Manage Topics',array('admin')); ?>]
</div>-->

<?php echo CHtml::form(); ?>

<?php echo CHtml::errorSummary($form); ?>

<p>
	<?php echo CHtml::activeLabel($form, 'title'); ?><br/>
	<?php echo CHtml::activeTextField($form, 'title', array('size' => 30, 'tabindex' => 10, 'class' => 'primary')); ?>
</p>

<p>
	<?php echo CHtml::activeLabel($form, 'body'); ?><br/>
	<?php echo CHtml::activeTextArea($form, 'body', array('rows' => 12, 'cols' => 40, 'tabindex' => 20, 'id' => 'topic_body')); ?>
</p>

<div class="action">
<?php echo CHtml::submitButton('Post Topic'); ?><span class='button_or'>or <?php echo CHtml::link('Cancel', array('forums', 'id' => 1)) ?></span>
</div>

</form>