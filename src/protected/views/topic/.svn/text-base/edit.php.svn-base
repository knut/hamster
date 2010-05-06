<h2>Update Topics <?php echo $topics->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Topics List',array('list')); ?>]
[<?php echo CHtml::link('New Topics',array('create')); ?>]
[<?php echo CHtml::link('Manage Topics',array('admin')); ?>]
</div>

<div class="yiiForm">
<?php echo CHtml::form(); ?>

<?php echo CHtml::errorSummary($topics); ?>

<div class="simple">
<?php echo CHtml::activeLabel($topics,'forum_id'); ?>
<?php echo CHtml::activeTextField($topics,'forum_id'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'user_id'); ?>
<?php echo CHtml::activeTextField($topics,'user_id'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'title'); ?>
<?php echo CHtml::activeTextField($topics,'title',array('size'=>60,'maxlength'=>255)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'created_at'); ?>
<?php echo CHtml::activeTextField($topics,'created_at'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'updated_at'); ?>
<?php echo CHtml::activeTextField($topics,'updated_at'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'hits'); ?>
<?php echo CHtml::activeTextField($topics,'hits'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'sticky'); ?>
<?php echo CHtml::activeTextField($topics,'sticky'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'posts_count'); ?>
<?php echo CHtml::activeTextField($topics,'posts_count'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'replied_at'); ?>
<?php echo CHtml::activeTextField($topics,'replied_at'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'locked'); ?>
<?php echo CHtml::activeTextField($topics,'locked'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'replied_by'); ?>
<?php echo CHtml::activeTextField($topics,'replied_by'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($topics,'last_post_id'); ?>
<?php echo CHtml::activeTextField($topics,'last_post_id'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton('Save'); ?>
</div>

</form>
</div><!-- yiiForm -->