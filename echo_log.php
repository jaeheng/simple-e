<?php
/**
 * 阅读文章页面
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>

<div class="container">
    <article class="post">
        <h2 class="post-title"><?php echo $log_title; ?></h2>

        <div class="post-meta">
            <img class="author-thumb" src="<?php echo getAuthorAvatar($author);?>" alt="jaeheng" width="32" height="32">
            <?php blog_author($author);?>
            <?php blog_sort($logid);?>
            <time class="post-date" datetime="<?php echo gmdate('Y-n-j', $date); ?>"><?php echo gmdate('Y-m-d H:i:s', $date); ?></time>
            <?php editflg($logid, $author); ?>
        </div>
        <section class="post-content">
            <?php echo $log_content; ?>
        </section>
        <p class="tags"><?php blog_tag($logid); ?></p>
    </article>
    <div class="post-neighbor">
        <?php neighbor_log($neighborLog); ?>
    </div>
    <div class="plugin-hook">
        <?php doAction('log_related', $logData); ?>
    </div>
    <div class="post-comment">
        <?php
            blog_comments($comments);
            blog_comments_post($logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark);
        ?>
    </div>
</div>
<?php include View::getView('footer'); ?>