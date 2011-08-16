<h2>New forum</h2>

<div class="actionBar">
[<?php echo CHtml::link('forum List',array('list')); ?>]
[<?php echo CHtml::link('Manage forum',array('admin')); ?>]
</div>

<div class="yiiForm">
<?php echo CHtml::form(); ?>

<?php echo CHtml::errorSummary($forum); ?>

<div class="simple">
<?php echo CHtml::activeLabel($forum,'name'); ?>
<?php echo CHtml::activeTextField($forum,'name',array('size'=>60,'maxlength'=>255)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($forum,'description'); ?>
<?php echo CHtml::activeTextArea($forum,'description',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($forum,'position'); ?>
<?php echo CHtml::activeTextField($forum,'position'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($forum,'created_at'); ?>
<?php echo CHtml::activeTextField($forum,'created_at'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabel($forum,'updated_at'); ?>
<?php echo CHtml::activeTextField($forum,'updated_at'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton('Create'); ?>
</div>

</form>
</div>