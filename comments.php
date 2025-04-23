<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Your_Theme_Name
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area bg-white p-3 container mt-3">

    <?php
    // You can start editing here -- including this comment!
    if ( have_comments() ) :
    ?>
        <h4 class="comments-title mb-4">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('One thought on &ldquo;%1$s&rdquo;', 'code-blowing'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html('%1$s Comments', $comment_count, 'comments title', 'code-blowing'),
                    number_format_i18n($comment_count)
                );
            }
            ?>
        </h4><!-- .comments-title -->

        <?php the_comments_navigation(); ?>

        <ol class="comment-list list-unstyled">
            <?php
            wp_list_comments(array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size' => 50,
                'callback'   => 'codeblowing_comment_callback', // Custom callback function for Bootstrap styling
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        the_comments_navigation();

        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
        ?>
            <p class="no-comments alert alert-warning"><?php esc_html_e('Comments are closed.', 'code-blowing'); ?></p>
        <?php
        endif;

    endif; // Check for have_comments().

    // Custom Bootstrap comment form
    comment_form(array(
        'class_form'           => 'comment-form',
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title mt-4">',
        'title_reply_after'    => '</h3>',
        'comment_notes_before' => '<p class="comment-notes text-muted">' . esc_html__('Your email address will not be published.', 'code-blowing') . '</p>',
        'comment_field'        => '<div class="form-group"><textarea id="comment" name="comment" class="form-control" rows="5" aria-required="true" placeholder="' . esc_attr__('Comment', 'code-blowing') . '"></textarea></div>',
        'fields'               => array(
            'author' => '<div class="mt-3"><input id="author" name="author" type="text" class="form-control" value="' . esc_attr($commenter['comment_author']) . '" size="30" placeholder="' . esc_attr__('Name', 'code-blowing') . '" required /></div>',
            'email'  => '<div class="mt-3"><input id="email" name="email" type="email" class="form-control" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" placeholder="' . esc_attr__('Email', 'code-blowing') . '" required /></div>',
            'url'    => '<div class="my-3"><input id="url" name="url" type="url" class="form-control" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" placeholder="' . esc_attr__('Website', 'code-blowing') . '" /></div>',
        ),
        'class_submit'         => 'btn btn-dark mt-3',
        'label_submit'         => esc_html__('Post Comment', 'code-blowing'),
        'logged_in_as'         => sprintf(
			'<p class="py-3 logged-in-as">%s%s</p>',
			sprintf(
				/* translators: 1: User name, 2: Edit user link, 3: Logout URL. */
				__( 'Logged in as %1$s. Want to <a href="%3$s">Log out?</a>' ),
				$user_identity,
				get_edit_user_link(),
				/** This filter is documented in wp-includes/link-template.php */
				wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ), get_the_ID() ) )
            ),
            ''
		)
    ));
    ?>

</div><!-- #comments -->