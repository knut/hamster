<h2>Topics List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New Topics',array('create')); ?>]
[<?php echo CHtml::link('Manage Topics',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?><?php foreach($topicsList as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('id')); ?>:
<?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('forum_id')); ?>:
<?php echo CHtml::encode($model->forum_id); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('user_id')); ?>:
<?php echo CHtml::encode($model->user_id); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('title')); ?>:
<?php echo CHtml::encode($model->title); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('created_at')); ?>:
<?php echo CHtml::encode($model->created_at); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('updated_at')); ?>:
<?php echo CHtml::encode($model->updated_at); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('hits')); ?>:
<?php echo CHtml::encode($model->hits); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('sticky')); ?>:
<?php echo CHtml::encode($model->sticky); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('posts_count')); ?>:
<?php echo CHtml::encode($model->posts_count); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('replied_at')); ?>:
<?php echo CHtml::encode($model->replied_at); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('locked')); ?>:
<?php echo CHtml::encode($model->locked); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('replied_by')); ?>:
<?php echo CHtml::encode($model->replied_by); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('last_post_id')); ?>:
<?php echo CHtml::encode($model->last_post_id); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>