<h1><?php echo Yii::t('messages', 'Login') ?></h1>
<p style="width: 30em; font-size: 13px; line-height: 1.em;">
<?php echo Yii::t('messages', 'You need an account to post messages.') ?> <?php echo CHtml::link(Yii::t('messages', 'Signup'), array('signup/')); ?> <?php echo Yii::t('messages', "if you don't have an account.") ?>
</p>

<h1><?php echo Yii::t('messages', 'Trouble Logging In?') ?></h1>
<p style="width: 30em; font-size: 13px; line-height: 1.em;">
If you're having trouble logging in, you can <a href="#" onclick="$('reset-password').toggle();; return false;">reset your password</a> to regain access using your email address.
</p>

<?php echo CHtml::form() ?>

<?php echo CHtml::errorSummary($user) ?>

<div class="simple">
<?php echo CHtml::activeLabel($user, 'username'); ?><br/>
<?php echo CHtml::activeTextField($user, 'username') ?>
</div>

<div class="simple">
<?php echo CHtml::activeLabel($user, 'password'); ?><br/>
<?php echo CHtml::activePasswordField($user, 'password') ?>
</div>

<p><label><?php echo CHtml::activeCheckBox($user, 'rememberMe'); ?> <?php echo Yii::t('messages', 'Remember me next time') ?></label></p>

<p><?php echo CHtml::submitButton('Login'); ?> <span class='button_or'><?php echo Yii::t('messages', 'or') ?> <a href="#" onclick="$('reset-password').toggle();; return false;"><?php echo Yii::t('messages', 'reset password') ?></a></span></p>

</form>

<form action="/basecamp/users" id="reset-password" method="post" style="display: none;">
<hr/>
<h5><?php echo Yii::t('messages', 'Reset Password') ?></h5>
<p><?php echo Yii::t('messages', 'Enter your email, and a brand new login key will be sent to you. Click the link in the email to log in, and then change your password.') ?></p>
<p><input id="email" name="email" size="30" type="text" value="" />
<br />
<?php echo CHtml::submitButton(Yii::t('messages', 'E-mail me the link')); ?> <span class='button_or'><?php echo Yii::t('messages', 'or') ?> <a href="#" onclick="$('reset-password').hide(); return false;"><?php echo Yii::t('messages', 'cancel') ?></a></span></p>
</form>
