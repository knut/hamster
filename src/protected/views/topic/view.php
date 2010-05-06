<div class="crumbs">
  <?php Yii::t('messages', 'This is a topic in') ?> <?php echo CHtml::link($topic->forum->name, array('forum/view', 'id' => $topic->forum->id)) ?>
</div>

<h1><?= $topic->title ?></h1>

<table border="0" cellspacing="0" cellpadding="0" class="posts wide">

<?php foreach($topic->posts as $post): ?>
<tr class="post hentry" id="post-<?php echo $post->id ?>-row">
	<td class="author vcard">
		<div class="date">
 			<a href="#post-<?php echo $post->id ?>" rel="bookmark" name="post-<?php echo $post->id ?>" id="post-<?php echo $post->id ?>">
				<abbr class="updated" title="<?php echo date_format(date_create($post->created_at), DateTime::ISO8601) ?>">
					<?php echo Yii::app()->dateFormatter->formatDateTime($post->created_at, 'medium', 'short') ?>
				</abbr>
			</a>
		</div>
		<img alt="Avatar" class="photo" height="32" src="http://www.gravatar.com/avatar/<?php echo md5($post->author->email) ?>.jpg&amp;rating=PG&amp;size=32" width="32" />
		<span class="fn"><?php echo CHtml::link($post->author->name, array('user/view', 'id' => $post->author->id)) ?></span>
		<span class="posts"><?php echo $post->author->postscounttext ?></span>
	</td>

	<td class="body entry-content" id="post-body-<?php echo $post->id ?>">
		
		<?= $post->getBodyHtml(); ?>

	</td>
</tr>

<tr class="spacer">
  <td colspan="2">
    <a name="posts-29247" id="posts-29247">&nbsp;</a>
  </td>
</tr>
<?php endforeach; ?>

<?php if(Yii::app()->user->isGuest): ?>
<tr>
	<td></td>
	<td class="reply">
		<p>
			<strong><?php echo CHtml::link(Yii::t('messages', 'Signup'), array('signup/'), array('class' => 'admin')) ?></strong> <?php echo Yii::t('messages', 'or') ?> 
			<strong><?php echo CHtml::link(Yii::t('messages', 'login'), array('login/'), array('class' => 'admin')) ?></strong> <?php echo Yii::t('messages', 'to post a reply') ?>.
		</p>
	</td>
</tr>

<?php else: ?>
	
<tr>
	<td valign="top"><strong><?php echo Yii::t('messages', 'Post your reply') ?></strong></td>
	<td>
		
		<?php echo CHtml::form(array('post/create')) ?>
			<textarea cols="100" id="post_body" name="Post[body]" rows="8"></textarea>
			<p>
			<input name="commit" type="submit" value="<?php echo Yii::t('messages', 'Save Reply') ?>" /> <input name="preview" type="submit" value="<?php echo Yii::t('messages', 'Preview') ?>" />
			</p>
		</form>
		
	</td>
</tr>

<!--	<div id="edit"></div>
	<tr>
		<td></td>
		<td class="reply">

			<a class="utility" href="#" onclick="ReplyForm.init(); return false;">Post your reply</a>

			<div id="reply" class="editbox">
				<div class="container">

					<?php echo CHtml::form(array('posts/create')) ?>
						
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td rowspan="2" width="70%">
									<textarea cols="40" id="post_body" name="Post[body]" rows="8"></textarea>
								</td>
								<td valign="top">
									<h5>Formatting Help</h5>

	                  <ul class="help">
	                    <li>*bold*
	                    &nbsp; &nbsp; &nbsp;
	                    _italics_
	                    &nbsp; &nbsp; &nbsp;<br />
	                    bq. <span>(quotes)</span></li>

	                    <li>"IBM":http://www.ibm.com</li>
	                    <li>* or # <span>(lists)</span></li>
	                  </ul>

	                </td>
	              </tr>
	              <tr>
	                <td valign="bottom" style="padding-bottom:15px;">

	                 <input name="commit" type="submit" value="Save Reply" /><span class="button_or">or <a href="#" onclick="$('reply').hide(); return false;">cancel</a></span>
	               </td>
	             </tr>
	          </table>
	        </form>      </div>
	    </div>
	    <script type="text/javascript">
	//<![CDATA[
	$('reply').hide();
	//]]>

	</script>

	  </td>
	</tr>-->

<?php endif; ?>

</table>
