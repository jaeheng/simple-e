<?php
/**
 * 侧边栏组件、页面模块
 */
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
<?php
//blog：导航
function blog_navi()
{
    global $CACHE;
    $navi_cache = $CACHE->readCache('navi');
    ?>
        <?php
        foreach ($navi_cache as $value):
            if ($value['pid'] != 0) {
                continue;
            }
            $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
            $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
            $current = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'menu-item active' : 'menu-item';
            ?>
            <li class="<?php echo $current; ?>">
                <a href="<?php echo $value['url']; ?>" <?php echo $newtab; ?>><?php echo $value['naviname']; ?></a>
            </li>
            <?php if (!empty($value['children'])) : ?>
                <?php foreach ($value['children'] as $row) {
                    echo '<li><a href="' . Url::sort($row['sid']) . '">&nbsp;&nbsp; ' . $row['sortname'] . '</a></li>';
                } ?>
            <?php endif; ?>

            <?php if (!empty($value['childnavi'])) {
                foreach ($value['childnavi'] as $row) {
                    $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                    echo '<li><a href="' . $row['url'] . "\" $newtab >&nbsp;&nbsp; " . $row['naviname'] . '</a></li>';
                }
            } ?>
        <?php endforeach; ?>
<?php } ?>
<?php
//blog：编辑
function editflg($logid, $author)
{
    $editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="' . BLOG_URL . 'admin/write_log.php?action=edit&gid=' . $logid . '" target="_blank">编辑</a>' : '';
    echo $editflg;
}

?>
<?php
//blog：分类
function blog_sort($blogid)
{
    global $CACHE;
    $log_cache_sort = $CACHE->readCache('logsort');
    if (!empty($log_cache_sort[$blogid])) {
        echo '<a href="';
        echo Url::sort($log_cache_sort[$blogid]['id']);
        echo '">';
        echo $log_cache_sort[$blogid]['name'];
        echo "</a>";
    } else {
        echo '未分类';
    }
}

//blog：文章标签
function blog_tag($blogid)
{
    global $CACHE;
    $log_cache_tags = $CACHE->readCache('logtags');
    if (!empty($log_cache_tags[$blogid])) {
        $tag = '';
        foreach ($log_cache_tags[$blogid] as $value) {
            $tag .= "<a href='" . Url::tag($value['tagurl']) . "' class='label label-tag'>#" . $value['tagname'] . '#</a>';
        }
        echo $tag;
    }
}

?>
<?php
//blog：文章作者
function blog_author($uid)
{
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a href="' . Url::author($uid) . "\" $title class='user'>$author</a>";
}

function get_author_by_uid($uid)
{
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    return $user_cache[$uid];
}

?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog)
{
    extract($neighborLog); ?>
    <?php if ($prevLog): ?>
    <div class="prev">
        <i class="iconfont icon-left"></i>
        上一篇
        <h3><a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title']; ?></a></h3>
    </div>
<?php endif; ?>
    <?php if ($nextLog): ?>
    <div class="next">
        下一篇
        <i class="iconfont icon-right"></i>
        <h3><a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title']; ?></a></h3>
    </div>
<?php endif; ?>
<?php } ?>
<?php
//blog：评论列表
function blog_comments($comments)
{
    extract($comments);
    if ($commentStacks): ?>
        <a name="comments"></a>
        <h3 class="comment-header">文章评论：</h3>
    <?php endif; ?>
    <?php
    $isGravatar = Option::get('isgravatar');
    foreach ($commentStacks as $cid):
        $comment = $comments[$cid];
        $comment['poster'] = $comment['url'] ? '<a href="' . $comment['url'] . '" target="_blank">' . $comment['poster'] . '</a>' : $comment['poster'];
        ?>
        <div class="comment" id="comment-<?php echo $comment['cid']; ?>">
            <a name="<?php echo $comment['cid']; ?>"></a>
            <?php if ($isGravatar == 'y'): ?>
                <div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>"/></div><?php endif; ?>
            <div class="comment-info">
                <div class="poster"><?php echo $comment['poster']; ?></div>
                <span class="comment-time"><?php echo $comment['date']; ?></span>
                <div class="comment-content"><?php echo $comment['content']; ?></div>
                <div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>"
                                              onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div>
            </div>
            <?php blog_comments_children($comments, $comment['children']); ?>
        </div>
    <?php endforeach; ?>
    <div class="pagination" id="pagenavi">
        <?php echo $commentPageUrl; ?>
    </div>
<?php } ?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children)
{
    $isGravatar = Option::get('isgravatar');
    foreach ($children as $child):
        $comment = $comments[$child];
        $comment['poster'] = $comment['url'] ? '<a href="' . $comment['url'] . '" target="_blank">' . $comment['poster'] . '</a>' : $comment['poster'];
        ?>
        <div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
            <a name="<?php echo $comment['cid']; ?>"></a>
            <?php if ($isGravatar == 'y'): ?>
                <div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>"/></div><?php endif; ?>
            <div class="comment-info">
                <b><?php echo $comment['poster']; ?> </b><br/><span
                        class="comment-time"><?php echo $comment['date']; ?></span>
                <div class="comment-content"><?php echo $comment['content']; ?></div>
                <?php if ($comment['level'] < 4): ?>
                    <div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>"
                                                  onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a>
                    </div><?php endif; ?>
            </div>
            <?php blog_comments_children($comments, $comment['children']); ?>
        </div>
    <?php endforeach; ?>
<?php } ?>
<?php
//blog：发表评论表单
function blog_comments_post($logid, $ckname, $ckmail, $ckurl, $verifyCode, $allow_remark)
{
    if ($allow_remark == 'y'): ?>
        <div id="comment-place">
            <div class="comment-post" id="comment-post">
                <div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);"
                                                                                    onclick="cancelReply()">取消回复</a>
                </div>
                <h3 class="comment-header">发表评论:<a name="respond"></a></h3>
                <form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom"
                      id="commentform">
                    <input type="hidden" name="gid" value="<?php echo $logid; ?>"/>
                    <?php if (ROLE == ROLE_VISITOR): ?>
                        <div class="form-group">
                            <label for="comname">昵称</label>
                            <input type="text" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22"
                                   tabindex="1" placeholder="昵称">
                        </div>
                        <div class="form-group">
                            <label for="commail">邮件地址 (选填)</label>
                            <input type="text" name="commail" maxlength="128" value="<?php echo $ckmail; ?>" size="22"
                                   tabindex="2" placeholder="填写邮件方便联系">
                        </div>
                        <div class="form-group">
                            <label for="comurl">个人主页 (选填)</label>
                            <input type="text" name="comurl" maxlength="128" value="<?php echo $ckurl; ?>" size="22"
                                   tabindex="3">
                        </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="comment">评论内容</label>
                        <textarea name="comment" id="comment" rows="5" tabindex="4" placeholder="请文明评论"></textarea>
                    </div>
                    <div class="form-group">
                        <?php echo $verifyCode; ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" id="comment_submit" value="发表评论" class="btn"
                               tabindex="6"/>
                    </div>
                    <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php } ?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome()
{
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL) {
        return true;
    } else {
        return FALSE;
    }
}

// 由gid获取文章信息
function getOneLogByGid($gid)
{
    $log = new Log_Model();
    return $log->getOneLogForHome($gid);
}

/**
 * 获取一段html中的第一个图片
 * @param $content
 * @return string img
 */
function getImgFromDesc($content)
{
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    return !empty($img[1]) ? $img[1][0] : TEMPLATE_URL . 'dist/images/article.jpg';
}

/**
 * 获取某用户的头像
 * @param int $uid 用户的id
 * @return string 头像的URL, 如该用户没有头像会返回一个默认头像
 */
function getAuthorAvatar($uid = 1)
{
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $photo = $user_cache[$uid]['photo'];
    return !empty($photo) ? BLOG_URL . $photo['src'] : BLOG_URL . 'admin/views/images/avatar.jpg';
}

/**
 * 获取一段html中的图片
 * @param $content
 * @return array imgs
 */
function getImgsFromContent($content)
{
    preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgs = array();
    foreach($img[1] as $key => $value) {
        $pos = strpos($value, 'http://');
        if ($pos !== 0) {
            $value = rtrim(BLOG_URL, "/") . $value;
        }
        $imgs[] = $value;
    }
    return count($imgs) > 3 ? array($imgs[0], $imgs[1], $imgs[2]) : $imgs;
}