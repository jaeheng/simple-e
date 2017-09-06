<?php
/**
 * 站点首页模板
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
doAction('index_loglist_top'); ?>

<div class="container">


    <?php
    if (!empty($logs)):
        foreach($logs as $value):
            $imgsrc = getImgFromDesc($value['content']);
            $imgs = getImgsFromContent($value['content']);
            ?>
            <article class="post">
                <h2 class="post-title"><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
                <section class="post-excerpt">
                    <div class="imgs">
                        <?php foreach ($imgs as $v): ?>
                        <div class="img">
                            <a href="<?php echo $value['log_url'];?>"><img src="<?php echo $v;?>" alt="<?php echo $value['log_title']; ?>"></a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <p><?php echo subString(strip_tags($value['log_description']),0,200);?></p>
                </section>
                <footer class="post-meta">
                    <img class="author-thumb" src="<?php echo getAuthorAvatar($value['author']);?>" alt="jaeheng" width="32" height="32">
                    <?php blog_author($value['author']); ?>
                    <?php blog_sort($value['logid']); ?>
                    <time class="post-date" datetime="<?php echo gmdate('Y-n-j', $value['date']); ?>"><?php echo gmdate('Y-m-d H:i:s', $value['date']); ?></time>
                    <?php editflg($value['logid'],$value['author']); ?>
                </footer>
            </article>
            <?php
        endforeach;
    else:
        ?>
        <li style="background-color: #fff;padding: 100px 30px;">未找到 <br>抱歉，没有符合您查询条件的结果。</li>
    <?php endif;?>

    <!--分页-->
    <div class="pagination" id="pagenavi">
        <?php echo $page_url;?>
    </div>
    <!--分页 ／-->
</div>

<?php include View::getView('footer'); ?>