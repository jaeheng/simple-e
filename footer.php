<?php
/**
 * 页面底部信息
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<div class="footer">
    <div class="container">
        &copy; 2017 Copyright <a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
        <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>
        Powered By <a href="http://www.emlog.net" target="_blank">emlog</a>
        <span class="pull-right">Theme by <a href="http://www.zhangziheng.com" target="_blank">jaeheng</a></span>
    </div>
</div>

<script src="<?php echo TEMPLATE_URL;?>js/jquery.min.js"></script>
<script src="<?php echo TEMPLATE_URL;?>js/main.js"></script>
<!--如果你使用的是ueditor， 可以打开下面的注释， 实现代码高亮的功能-->
<!--<script src="--><?php //echo BLOG_URL; ?><!--admin/editor/ueditor.parse.js"></script>-->
<!--<script src="--><?php //echo BLOG_URL; ?><!--admin/editor/third-party/SyntaxHighlighter/shCore.js"></script>-->
<!--<link rel="stylesheet" href="--><?php //echo BLOG_URL; ?><!--admin/editor/third-party/SyntaxHighlighter/shCoreDefault.css">-->
<!--<script>SyntaxHighlighter.all();</script>-->
</body>
</html>