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
</body>
</html>