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

        add_action('admin_menu', [$this, 'disableMenuItems']);
    }

    public function disableMenuItems()
    {
        // remove comments from sidebar menu
        remove_menu_page('edit-comments.php');

        // remove theme patterns from sidebar menu
        remove_submenu_page('themes.php', 'site-editor.php?path=/patterns');
    }
}

new AdminConfig();
