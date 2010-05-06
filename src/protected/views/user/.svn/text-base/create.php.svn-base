<?php $this->pageTitle = Yii::t('messages', 'Sign up'); ?>

<h1><?php echo Yii::t('messages', 'Signup') ?></h1>

<?php echo CHtml::form() ?>

<?php echo CHtml::errorSummary($form) ?>

<p class="help"><?php echo Yii::t('messages', 'Logins should start with least 2 characters and may consist of letters, numbers, or the underscore.') ?></p>

<p>
<?php echo CHtml::activeLabel($form, 'username') ?><br/>
<?php echo CHtml::activeTextField($form, 'username', array('size' => 30)) ?>
</p>

<p>
<?php echo CHtml::activeLabel($form, 'email') ?><br/>
<?php echo CHtml::activeTextField($form, 'email', array('size' => 30)) ?>
</p>

<p>
<?php echo CHtml::activeLabel($form, 'display_name') ?><br/>
<?php echo CHtml::activeTextField($form, 'display_name', array('size' => 30)) ?>
</p>

<p>
<?php echo CHtml::activeLabel($form, 'password') ?><br/>
<?php echo CHtml::activePasswordField($form, 'password', array('size' => 30)) ?>
</p>

<p>
<?php echo CHtml::activeLabel($form, 'password_confirmation') ?><br/>
<?php echo CHtml::activePasswordField($form, 'password_confirmation', array('size' => 30)) ?>
</p>

<?php if(extension_loaded('gd')): ?>
<?php echo CHtml::activeLabel($form, 'verify_code'); ?>
	<div>
	<?php $this->widget('CCaptcha', array('buttonLabel' => Yii::t('messages', 'Get a new code'))); ?>
	<br/>
	<?php echo CHtml::activeTextField($form, 'verify_code'); ?>
	</div>
	<p class="entryhelp"><?php echo Yii::t('messages', 'Please enter the letters as they are shown in the image above.') ?>
	<br/><?php echo Yii::t('messages', 'Letters are not case-sensitive.') ?></p>
<?php endif; ?>

<?php echo CHtml::submitButton(Yii::t('messages', 'Sign up!')); ?>

</form>
