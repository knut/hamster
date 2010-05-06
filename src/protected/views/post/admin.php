<h2>Managing Posts</h2>

<div class="actionBar">
[<?php echo CHtml::link('Posts List',array('list')); ?>]
[<?php echo CHtml::link('New Posts',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $this->generateColumnHeader('id'); ?></th>
    <th><?php echo $this->generateColumnHeader('user_id'); ?></th>
    <th><?php echo $this->generateColumnHeader('topic_id'); ?></th>
    <th><?php echo $this->generateColumnHeader('body'); ?></th>
    <th><?php echo $this->generateColumnHeader('created_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('updated_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('forum_id'); ?></th>
    <th><?php echo $this->generateColumnHeader('body_html'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($postsList as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->user_id); ?></td>
    <td><?php echo CHtml::encode($model->topic_id); ?></td>
    <td><?php echo CHtml::encode($model->body); ?></td>
    <td><?php echo CHtml::encode($model->created_at); ?></td>
    <td><?php echo CHtml::encode($model->updated_at); ?></td>
    <td><?php echo CHtml::encode($model->forum_id); ?></td>
    <td><?php echo CHtml::encode($model->body_html); ?></td>
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