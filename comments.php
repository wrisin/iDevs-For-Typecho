<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php function threadedComments($comments, $singleCommentOptions) {
 
$commentClass = '';
if ($comments->authorId) {
if ($comments->authorId == $comments->ownerId) {
$commentClass .= ' comment-by-author';
} else {
$commentClass .= ' comment-by-user';
}
}
 
$commentLevelClass = $comments->_levels > 0 ? ' comment-child' : ' comment-parent';
?>
<li id="<?php $comments->theId(); ?>" class="comment depth-1<?php
if ($comments->_levels > 0) {
echo ' comment-child';
$comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
echo ' comment-parent';
}
$comments->alt(' thread-odd', ' thread-even');
echo $commentClass;
//以上部份 不用理会，是判断一些奇偶数评论和作者类的，下面的才是需要修改的，根据需要修改吧， php部份不需要 修改，只需要修改 HTML 部分，下面是我现在用的
?>">
<div id="div-comment-<?php echo $comments->cid;?>" class="comment-body">
<div class="comment-author vcard">
          <?php
            //头像CDN by Rich
            $host = 'https://secure.gravatar.com'; //自定义头像CDN服务器
            $url = '/avatar/'; //自定义头像目录,一般保持默认即可
            $size = '32'; //自定义头像大小
            $rating = Helper::options()->commentsAvatarRating;
            $hash = md5(strtolower($comments->mail));
            $avatar = $host . $url . $hash . '?s=' . $size . '&r=' . $rating . '&d=';
            ?>
         <img class="avatar" src="<?php echo $avatar ?>">
<cite class="fn">
<?php $singleCommentOptions->beforeAuthor();
$comments->author();$singleCommentOptions->afterAuthor(); //输出评论者 ?>
</cite><span class="says">说道：</span>
</div>
<div class="comment-meta commentmetadata">
<a href="<?php $comments->permalink(); ?>"><?php $singleCommentOptions->beforeDate();
$comments->date($singleCommentOptions->dateFormat);
$singleCommentOptions->afterDate();  //输出评论日期 ?></a></div>
<?php $comments->content(); //输出评论内容，包含 <p></p> 标签 ?>
<div class="reply">
<?php $comments->reply($singleCommentOptions->replyWord); //输出 回复 链接?>
</div>
</div>
<?php if ($comments->children) { ?>
<ul class="children">
<?php $comments->threadedComments($singleCommentOptions); //评论嵌套?>
</ul>
<?php } ?>
 
</li>
<?php
}
?>
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
	<h3 id="comments"><?php $this->commentsNum(_t('一条回应'), _t('2条回应'), _t('%d条回应')); ?>：“<?php $this->title() ?>”</h3>
	<ol class="commentlist"><?php $comments->listComments(array('before'=>'' , 'after'=>'')); ?></ol>
	<?php endif; ?>
	<div class="navigation">
		<div class="alignleft"></div>
		<div class="alignright"></div>
	</div>
	<?php if($this->allow('comment')): ?>
	<div id="<?php $this->respondId(); ?>">
	<div id="respond" class="comment-respond">
	<h3 id="reply-title" class="comment-reply-title">发表评论 <small><?php $comments->cancelReply(); ?></small></h3>
	<form action="<?php $this->commentUrl() ?>" method="post" id="commentform" class="comment-form">
	<?php if($this->user->hasLogin()): ?>
	<p class="logged-in-as"><a href="<?php $this->options->profileUrl(); ?>" aria-label="已登入为<?php $this->user->screenName(); ?>。编辑您的个人资料。">已登入为<?php $this->user->screenName(); ?></a>。<a href="<?php $this->options->logoutUrl(); ?>">登出？</a></p>
	<?php else: ?>
	<p class="comment-notes"><span id="email-notes">电子邮件地址不会被公开。</span> 必填项已用<span class="required">*</span>标注</p>
	<p class="comment-form-author"><label for="author">姓名 <span class="required">*</span></label> <input id="author" name="author" type="text" value="<?php $this->remember('author'); ?>" size="30" maxlength="245" aria-required="true" required="required"></p>
    <p class="comment-form-email"><label for="email">电子邮件 <span class="required">*</span></label> <input id="email" name="mail" type="text" value="<?php $this->remember('mail'); ?>" size="30" maxlength="100" aria-describedby="email-notes" aria-required="true" required="required"></p>
    <p class="comment-form-url"><label for="url">站点</label> <input id="url" name="url" type="text" value="<?php $this->remember('url'); ?>" size="30" maxlength="200"></p>
	<?php endif; ?>
	<p class="comment-form-comment"><label for="comment">评论</label><textarea id="comment" name="text" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea><textarea name="comment" cols="100%" rows="4" style="display:none"></textarea></p>
    <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit" value="发表评论"> <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID">
    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
    </p>
	</form>
	</div>
	</div>
	<?php else: ?>
    <?php endif; ?>