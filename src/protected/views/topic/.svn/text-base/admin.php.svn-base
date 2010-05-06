<h2>Managing Topics</h2>

<div class="actionBar">
[<?php echo CHtml::link('Topics List',array('list')); ?>]
[<?php echo CHtml::link('New Topics',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $this->generateColumnHeader('id'); ?></th>
    <th><?php echo $this->generateColumnHeader('forum_id'); ?></th>
    <th><?php echo $this->generateColumnHeader('user_id'); ?></th>
    <th><?php echo $this->generateColumnHeader('title'); ?></th>
    <th><?php echo $this->generateColumnHeader('created_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('updated_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('hits'); ?></th>
    <th><?php echo $this->generateColumnHeader('sticky'); ?></th>
    <th><?php echo $this->generateColumnHeader('posts_count'); ?></th>
    <th><?php echo $this->generateColumnHeader('replied_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('locked'); ?></th>
    <th><?php echo $this->generateColumnHeader('replied_by'); ?></th>
    <th><?php echo $this->generateColumnHeader('last_post_id'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($topicsList as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->forum_id); ?></td>
    <td><?php echo CHtml::encode($model->user_id); ?></td>
    <td><?php echo CHtml::encode($model->title); ?></td>
    <td><?php echo CHtml::encode($model->created_at); ?></td>
    <td><?php echo CHtml::encode($model->updated_at); ?></td>
    <td><?php echo CHtml::encode($model->hits); ?></td>
    <td><?php echo CHtml::encode($model->sticky); ?></td>
    <td><?php echo CHtml::encode($model->posts_count); ?></td>
    <td><?php echo CHtml::encode($model->replied_at); ?></td>
    <td><?php echo CHtml::encode($model->locked); ?></td>
    <td><?php echo CHtml::encode($model->replied_by); ?></td>
    <td><?php echo CHtml::encode($model->last_post_id); ?></td>
    <td>
      <?php echo CHtml::link('Update',array('update','id'=>$model->id)); ?>
      <?php echo CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->id),
      	  'confirm'=>"Are you sure to delete #{$model->id}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>