<?php
/*
Template Name:simple-e
Description: <span style="font-size: 24px; color: #43A6F8;">简洁</span>
Version:1.0.0
Author:jaeheng
Author Url:http://www.zhangziheng.com
Sidebar Amount:0
*/
if (!defined('EMLOG_ROOT')) exit('error!');
require_once View::getView('module');
$version = 'v1.0.0';
?>
<!doctype html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="<?php echo $site_key; ?>"/>
    <meta name="description" content="<?php echo $site_description; ?>"/>
    <meta name="generator" content="emlog"/>
    <title><?php echo $site_title; ?></title>
    <link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo BLOG_URL; ?>rss.php"/>
    <link rel="stylesheet" href="//at.alicdn.com/t/font_391098_7nn44eoa505jc3di.css">
    <link rel="stylesheet" href="<?php echo TEMPLATE_URL; ?>css/main.css?version=<?php echo $version; ?>">
    <script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
</head>
<body>
<!--[if lte IE 8]>
<div id="browsehappy">
    您正在使用的浏览器版本过低，请<a href="http://browsehappy.com/" target="_blank">
    <strong>升级您的浏览器</strong></a>，获得最佳的浏览体验！
</div>
<![endif]-->

<?php doAction('index_head'); ?>

<!--头部区域-->
<header id="header" class="header">
    <div class="container">
        <a href="<?php echo BLOG_URL; ?>" class="site-name">
            <h1 title="<?php echo $blogname; ?>"><?php echo $blogname; ?></h1>
        </a>

        <ul class="menu toggle" id="menu">
            <li>
                <h3 class="title">
                    菜单
                    <i class="iconfont icon-close"></i>
                </h3>
            </li>
            <?php blog_navi(); ?>
            <a href="<?php echo BLOG_URL; ?>rss.php" class="rss"><i class="iconfont icon-rss"></i> 订阅我</a>
        </ul>
        <i class="iconfont icon-menu" v-show="menu"></i>
        <form action="<?php echo BLOG_URL; ?>index.php" method="get" class="search" id="search">
            <div class="input-group">
                <input type="search" name="keyword" class="keyword" id="keyword" value="<?php echo $keyword; ?>" placeholder="search...">
                <i class="iconfont icon-search" v-show="keyword"></i>
            </div>
        </form>
    </div>
</header>
<!--头部区域 ／-->