<?php
/**
 * 自建页面模板
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<div class="container">
    <article class="post">
        <h2 class="post-title" style="text-align: center"><?php echo $log_title; ?> <?php editflg($logid,$author); ?></h2>
        <section class="post-content">
            <?php echo $log_content; ?>
        </section>
        <p style="text-align: right">本文最后编辑于: <?php echo gmdate('Y-n-j h:i:s', $date); ?></p>
    </article>
    <div class="post-comment">
        <?php
        blog_comments($comments);
        blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark);
        ?>
    </div>
</div>
<?php
include View::getView('footer');
?>