<?php
namespace wpdev;

class RedirectConfig
{
    public function __construct()
    {
        add_action('template_redirect', [$this, 'redirectHome']);
    }

    public function redirectHome()
    {
        if (!is_home() && !is_admin()) {
            wp_redirect(home_url(), 301);
        }
    }
}

new RedirectConfig();
