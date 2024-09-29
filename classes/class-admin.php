<?php
namespace wpdev;

class AdminConfig
{
    public function __construct()
    {
        // disable theme/plugin editor
        define('DISALLOW_FILE_EDIT', true);

        // disable plugin auto updates
        add_filter('auto_update_plugin', '__return_true');
        // disable theme auto updates
        add_filter('auto_update_theme', '__return_true');
    }
}

new AdminConfig();
