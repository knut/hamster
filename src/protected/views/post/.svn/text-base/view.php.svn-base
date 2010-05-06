<h2>View Posts <?php echo $posts->id; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Posts List',array('list')); ?>]
[<?php echo CHtml::link('New Posts',array('create')); ?>]
[<?php echo CHtml::link('Update Posts',array('edit','id'=>$posts->id)); ?>]
[<?php echo CHtml::linkButton('Delete Posts',array('submit'=>array('delete','id'=>$posts->id),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage Posts',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('user_id')); ?>
</th>
    <td><?php echo CHtml::encode($posts->user_id); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('topic_id')); ?>
</th>
    <td><?php echo CHtml::encode($posts->topic_id); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('body')); ?>
</th>
    <td><?php echo CHtml::encode($posts->body); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('created_at')); ?>
</th>
    <td><?php echo CHtml::encode($posts->created_at); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('updated_at')); ?>
</th>
    <td><?php echo CHtml::encode($posts->updated_at); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('forum_id')); ?>
</th>
    <td><?php echo CHtml::encode($posts->forum_id); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($posts->getAttributeLabel('body_html')); ?>
</th>
    <td><?php echo CHtml::encode($posts->body_html); ?>
</td>
</tr>
</table>
