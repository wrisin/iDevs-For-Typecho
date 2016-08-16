<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
function themeConfig($form) {
    $ICP = new Typecho_Widget_Helper_Form_Element_Text('ICP', NULL, NULL, _t('ICP备案号'), _t('在这里填入ICP备案号, 以在网站底部显示，不填则不显示'));
    $form->addInput($ICP);

    $link = new Typecho_Widget_Helper_Form_Element_Textarea('link', NULL, NULL, _t('友情链接'), _t('每行一条，例：<br><code>&lt;li&gt;&lt;a target="_blank" href="http://idevs.cn/"&gt;设计笔记&lt;/a&gt;&lt;/li&gt;</code>'));
    $form->addInput($link);
	
    $ol_code = new Typecho_Widget_Helper_Form_Element_Textarea('ol_code', NULL, NULL, _t('需要重载的代码'), _t('可以使用CNZZ、百度统计、腾讯分析的统计代码，也可以放置需要重载的js代码（页脚隐藏）。'));
    $form->addInput($ol_code);

    $my_code = new Typecho_Widget_Helper_Form_Element_Textarea('my_code', NULL, NULL, _t('自定义代码或引用'), _t('可以放置css、js脚本，也可以引入第三方js或者css样式（此处代码不会被重载且页脚隐藏）。'));
    $form->addInput($my_code);
	
    $indexBlock = new Typecho_Widget_Helper_Form_Element_Checkbox('indexBlock', 
    array('ShowSlide' => _t('显示图片轮播'),
    'ShowTopHome' => _t('显示评论轮播'),
	'ShowThumbnail' => _t('显示缩略图')),
    array('ShowSlide', 'ShowTopHome', 'ShowThumbnail'), _t('首页显示'));
    
    $form->addInput($indexBlock->multiMode());
}

/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

