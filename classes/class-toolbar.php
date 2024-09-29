<?php
namespace wpdev;

class ToolbarConfig
{
    public function __construct()
    {
        // disable toolbar for all users
        add_filter('show_admin_bar', '__return_false');
    }
}

new ToolbarConfig();
