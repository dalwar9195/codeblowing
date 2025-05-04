<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Custom callback function for Bootstrap comment styling
function codeblowing_comment_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class('media border-bottom mb-4 pb-3'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="media-body d-flex gap-4">
            <div class="comment-author vcard">
                <?php
                if ($args['avatar_size'] != 0) {
                    echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'rounded-circle mr-3'));
                }
                
                ?>
            </div>
            <div class="comment-info">
                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="comment-awaiting-moderation text-muted"><?php _e('Your comment is awaiting moderation.', 'code-blowing'); ?></em>
                    <br />
                <?php endif; ?>

                <div class="comment-meta commentmetadata">
                    <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>" class="text-muted">
                        <time datetime="<?php comment_time('c'); ?>">
                            <?php
                            printf(__('<cite class="fn">%s</cite>'), get_comment_author_link());
                            printf(__('%1$s at %2$s', 'code-blowing'), get_comment_date(), get_comment_time()); ?>
                        </time>
                    </a>
                    <?php edit_comment_link(__('(Edit)', 'code-blowing'), '  ', ''); ?>
                </div>

                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>

                <div class="reply">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'class'     => 'btn btn-sm btn-outline-secondary',
                    )));
                    ?>
                </div>
            </div>
        </div>
    </li>
    <?php
}