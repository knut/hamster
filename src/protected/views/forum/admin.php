<h2>Managing forum</h2>

<div class="actionBar">
[<?php echo CHtml::link('forum List',array('list')); ?>]
[<?php echo CHtml::link('New forum',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $this->generateColumnHeader('id'); ?></th>
    <th><?php echo $this->generateColumnHeader('name'); ?></th>
    <th><?php echo $this->generateColumnHeader('description'); ?></th>
    <th><?php echo $this->generateColumnHeader('topics_count'); ?></th>
    <th><?php echo $this->generateColumnHeader('posts_count'); ?></th>
    <th><?php echo $this->generateColumnHeader('position'); ?></th>
    <th><?php echo $this->generateColumnHeader('created'); ?></th>
    <th><?php echo $this->generateColumnHeader('modified'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($forumList as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->name); ?></td>
    <td><?php echo CHtml::encode($model->description); ?></td>
    <td><?php echo CHtml::encode($model->topics_count); ?></td>
    <td><?php echo CHtml::encode($model->posts_count); ?></td>
    <td><?php echo CHtml::encode($model->position); ?></td>
    <td><?php echo CHtml::encode($model->created); ?></td>
    <td><?php echo CHtml::encode($model->modified); ?></td>
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