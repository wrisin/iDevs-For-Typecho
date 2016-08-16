<?php
/**
 * 设计笔记同名主题，由<a href="https://auauau.cn/" target="_blank">Ace</a>移植，爱这个板子的话就请给移植作者一点关爱(｡・`ω´･)。
 * 
 * @package iDevs
 * @author Tokin
 * @version 1.2.7
 * @link http://www.idevs.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 ?>
<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="<?php $this->options->charset(); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
	<meta name="robots" content="noindex,follow">
	<script type="text/javascript" src="<?php $this->options->themeUrl('static/jquery.js?ver=1.12.4'); ?>"></script>
	<script type="text/javascript" src="<?php $this->options->themeUrl('static/jquery-migrate.min.js?ver=1.4.1'); ?>"></script>
    <?php $this->header(); ?>
    <link type="image/vnd.microsoft.icon" href="<?php $this->options->themeUrl('static/favicon.png'); ?>" rel="shortcut icon">
    <link href="<?php $this->options->themeUrl('style.css'); ?>" type="text/css" rel="stylesheet" />
    <link href="<?php $this->options->themeUrl('static/unslider.css'); ?>" type="text/css" rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/r29/html5.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        #red {background: #f45;}
        #yellow {background: #FFE27A;}
        #green {background: #5DA;}
        #blue {background: #3cf;}
    </style>
</head>
<body id="null">
    <section id="index">
        <header id="header">
            <div class="skin">
                <i class="red"></i>
                <i class="yellow"></i>
                <i class="green"></i>
                <i class="blue"></i>
                <i class="null"></i>
            </div>
            <nav id="topMenu" class="menu_click">
			    <ul>
                    <li><a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
                    <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
                    <?php while($pages->next()): ?>
                    <li><a href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
                    <?php endwhile; ?>
                    <i class="i_1"></i>
                    <i class="i_2"></i>
				</ul>
            </nav>
            <div class="search_click"></div>
        </header>
        <div class="pjax">
            <main id="main">
                <?php if($this->is('page') || $this->is('single')): ?>
                <!--文章和页面-->
                <article class="post_article" itemscope="" itemtype="http://schema.org/BlogPosting">
            <section id="banner">
                <h1 itemprop="name headline" class="post_title"><?php $this->title() ?></h1>
                <ul class="info">
                    <li><?php $this->date('Y年m月d日'); ?></li>
                    <li><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></li>
                </ul>
				<?php $this->content(); ?>
            </section>
                </article>
				<?php $this->need('comments.php'); ?>
                <?php else: ?>
			<?php if (!empty($this->options->indexBlock) && in_array('ShowSlide', $this->options->indexBlock)): ?>
            <section id="slide">
                <ul>
                    <li><img src="https://unsplash.it/800/300/" srcset="https://unsplash.it/1600/600/ 2x" /></li>
                    <li><img src="https://unsplash.it/800/302" srcset="https://unsplash.it/1600/602/ 2x" /></li>
                    <li><img src="https://unsplash.it/800/301/" srcset="https://unsplash.it/1600/601/ 2x" /></li>
                </ul>
            </section>
			<?php endif; ?>
			<?php if (!empty($this->options->indexBlock) && in_array('ShowTopHome', $this->options->indexBlock)): ?>
            <section class="top_home">
                <ul>
					<?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
                    <?php while($comments->next()): ?>
                    <li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
                    <?php endwhile; ?>
                </ul>
            </section>
			<?php endif; ?>
                    <!--文章列表-->
                <?php while($this->next()): ?>
                    <article class="post post-list" itemscope="" itemtype="http://schema.org/BlogPosting">
					    <?php if (!empty($this->options->indexBlock) && in_array('ShowThumbnail', $this->options->indexBlock)): ?>
                        <?php if($this->attachments(1)->attachment->mime == ('image/jpeg' || 'image/png' || 'image/gif')): ?><div class="thumbnail"><a href="<?php $this->permalink() ?>"><img src="<?php $this->options->themeUrl('static/timthumb.php'); ?>?src=<?php $this->attachments(1)->attachment->url(); ?>&h=225&w=300&zc=1" /></a></div><?php endif; ?>
                        <?php endif; ?>
						<div class="info">
                            <h2 itemprop="name headline" class="title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
                            <span class="time"><?php $this->date('Y年m月d日'); ?></span>
                            <span class="comment"><?php $this->commentsNum('暂无评论', '1 条评论', '%d 条评论'); ?></span>
                            <p itemprop="post">
                                <?php $this->excerpt(200, '...'); ?>
                            </p>
                        </div>
                    </article>
                    <div class="clearer"></div>
                    <?php endwhile; ?>
					<nav class="navigator"><?php $this->pageLink('New posts', 'prev') ?><?php $this->pageLink('Old posts', 'next') ?></nav>
                    <?php endif; ?>
                        <div class="clearer"></div>
            </main>
        </div>
		<footer id="footer">
            <section class="links_adlink">
                <ul class="container">
				<?php $this->options->link() ?>
                </ul>
            </section>
            Theme is iDevs by <a target="_blank" href="http://www.idevs.cn/">Tokin</a>
            <br>
            &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
			<?php if ($this->options->ICP): ?><?php $this->options->ICP() ?><?php endif; ?>
			<a class="back2top" style="display: block;"></a>
        </footer>
	</section>
    <div class="clearer" style="height:1px;"></div>
    <div class="search_form">
        <form method="get" action="./">
            <input class="search_key" name="s" autocomplete="off" placeholder="Enter search keywords..." type="text" value="" required="required">
            <button alt="Search" type="submit">Search</button>
        </form>
        <div class="search_close"></div>
    </div>
	<?php if ($this->options->my_code) echo "<div style=\"display:none\">".$this->options->my_code."</div>\n";
    echo "<script style=\"display:none\">\nfunction index_overloaded(){\n".$this->options->ol_code."\n}\n</script>\n"; ?>
    <script type='text/javascript' src='//cdn.bootcss.com/jquery/1.8.3/jquery.min.js'></script>
    <script src="<?php $this->options->themeUrl('static/unslider-min.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('static/interactive.js'); ?>"></script>
</body>
</html>