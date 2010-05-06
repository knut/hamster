<h2>Update Posts <?php echo $posts->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Posts List',array('list')); ?>]
[<?php echo CHtml::link('New Posts',array('create')); ?>]
[<?php echo CHtml::link('Manage Posts',array('admin')); ?>]
</div>

<div class="yiiForm">
<?php echo CHtml::form(); ?>

<?php echo CHtml::errorSummary($posts); ?>

<div class="simple">
<?php echo CHtml::activeLabel($posts,'user_id'); ?>
<?php echo CHtml::activeTextField($posts,'user_id'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($posts,'topic_id'); ?>
<?php echo CHtml::activeTextField($posts,'topic_id'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($posts,'body'); ?>
<?php echo CHtml::activeTextArea($posts,'body',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($posts,'created_at'); ?>
<?php echo CHtml::activeTextField($posts,'created_at'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($posts,'updated_at'); ?>
<?php echo CHtml::activeTextField($posts,'updated_at'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($posts,'forum_id'); ?>
<?php echo CHtml::activeTextField($posts,'forum_id'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($posts,'body_html'); ?>
<?php echo CHtml::activeTextArea($posts,'body_html',array('rows'=>6, 'cols'=>50)); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton('Save'); ?>
</div>

</form>
</div><!-- yiiForm -->