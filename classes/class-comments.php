<?php
namespace wpdev;

class CommentsConfig
{
    public function __construct()
    {
        // disable support for post comments
        add_action('admin_init', [$this, 'disableCommentSupport'], 100);

        // disable comments on frontend
        add_filter('comments_open', '__return_false', 20, 2);
        add_filter('pings_open', '__return_false', 20, 2);

        // hide existing comments
        add_filter('comments_array', '__return_empty_array', 10, 2);
    }

    public function disableCommentSupport()
    {
        global $pagenow;

        if ($pagenow === 'edit-comments.php') {
            wp_safe_redirect(admin_url(), 301);
            exit();
        }

        foreach (get_post_types() as $post_type) {
            if (post_type_supports($post_type, 'comments')) {
                remove_post_type_support($post_type, 'comments');
                remove_post_type_support($post_type, 'trackbacks');
            }
        }

        remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    }
}

new CommentsConfig();
