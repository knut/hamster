<h2>Managing Users</h2>

<div class="actionBar">
[<?php echo CHtml::link('Users List',array('list')); ?>]
[<?php echo CHtml::link('New Users',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $this->generateColumnHeader('id'); ?></th>
    <th><?php echo $this->generateColumnHeader('login'); ?></th>
    <th><?php echo $this->generateColumnHeader('email'); ?></th>
    <th><?php echo $this->generateColumnHeader('password_hash'); ?></th>
    <th><?php echo $this->generateColumnHeader('created_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('last_login_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('admin'); ?></th>
    <th><?php echo $this->generateColumnHeader('posts_count'); ?></th>
    <th><?php echo $this->generateColumnHeader('last_seen_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('display_name'); ?></th>
    <th><?php echo $this->generateColumnHeader('updated_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('website'); ?></th>
    <th><?php echo $this->generateColumnHeader('login_key'); ?></th>
    <th><?php echo $this->generateColumnHeader('login_key_expires_at'); ?></th>
    <th><?php echo $this->generateColumnHeader('activated'); ?></th>
    <th><?php echo $this->generateColumnHeader('bio'); ?></th>
    <th><?php echo $this->generateColumnHeader('bio_html'); ?></th>
    <th><?php echo $this->generateColumnHeader('openid_url'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($usersList as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->id,array('show','id'=>$model->id)); ?></td>
    <td><?php echo CHtml::encode($model->login); ?></td>
    <td><?php echo CHtml::encode($model->email); ?></td>
    <td><?php echo CHtml::encode($model->password_hash); ?></td>
    <td><?php echo CHtml::encode($model->created_at); ?></td>
    <td><?php echo CHtml::encode($model->last_login_at); ?></td>
    <td><?php echo CHtml::encode($model->admin); ?></td>
    <td><?php echo CHtml::encode($model->posts_count); ?></td>
    <td><?php echo CHtml::encode($model->last_seen_at); ?></td>
    <td><?php echo CHtml::encode($model->display_name); ?></td>
    <td><?php echo CHtml::encode($model->updated_at); ?></td>
    <td><?php echo CHtml::encode($model->website); ?></td>
    <td><?php echo CHtml::encode($model->login_key); ?></td>
    <td><?php echo CHtml::encode($model->login_key_expires_at); ?></td>
    <td><?php echo CHtml::encode($model->activated); ?></td>
    <td><?php echo CHtml::encode($model->bio); ?></td>
    <td><?php echo CHtml::encode($model->bio_html); ?></td>
    <td><?php echo CHtml::encode($model->openid_url); ?></td>
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