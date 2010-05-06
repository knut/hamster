<?php if($notice): ?>
<p class="notice"><?php echo $notice ?></p>
<?php endif; ?>

<h1>Settings</h1>
<h2>for <?php echo $users->display_name ?> (<?php echo $users->username ?>)</h2>

<?php echo CHtml::errorSummary($users); ?>

<h3>Basic</h3>

<?php echo CHtml::form(); ?>

<p>
<?php echo CHtml::activeLabel($users, 'email'); ?><br/>
<?php echo CHtml::activeTextField($users, 'email', array('size' => 30, 'maxlength' => 255)); ?>
</p>

<p>
<?php echo CHtml::activeLabel($users, 'password'); ?><br/>
<p class="entryhelp">Enter a new password twice to change your password. (must be longer than 5 characters)</p>
<?php echo CHtml::passwordField('password', '', array('size' => 16)); ?> <span class="entryhelp">(once)</span><br/>
<?php echo CHtml::passwordField('password_confirmation', '', array('size' => 16)); ?> <span class="entryhelp">(and again)</span>
</p>

<p>
<?php echo CHtml::submitButton('Change e-mail or password'); ?><span class="button_or">or <?php echo CHtml::link('cancel', array('list')); ?></span>
</p>

</form>

<h3>User Profile</h3>

<?php echo CHtml::form(); ?>

<p>
<?php echo CHtml::activeLabel($users, 'display_name'); ?><br/>
<?php echo CHtml::activeTextField($users, 'display_name', array('size' => 30)); ?>
</p>

<p>
<?php echo CHtml::activeLabel($users, 'openid_url'); ?><br/>
<p class="entryhelp">Enter your OpenID Identity Url if you know it.</p>
<?php echo CHtml::activeTextField($users, 'openid_url', array('size' => 30)); ?>
</p>

<p>
<?php echo CHtml::activeLabel($users, 'website'); ?><br/>
<?php echo CHtml::activeTextField($users, 'website', array('size' => 30)); ?> <span class="entryhelp">(without http://)</span>
</p>

<p>
<?php echo CHtml::activeLabel($users, 'bio'); ?><br/>
<?php echo CHtml::activeTextArea($users, 'bio', array('rows' => 10, 'cols' => 40, 'style' => 'width: 99%;')); ?>
</p>

<p>
<?php echo CHtml::submitButton('Update profile'); ?><span class="button_or">or <?php echo CHtml::link('cancel', array('list')); ?></span>
</p>

</form>
