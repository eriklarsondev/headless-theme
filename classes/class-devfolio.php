<?php
namespace wpdev;

class Devfolio
{
    public function __construct()
    {
    }

    /**************************************************************************
     **************************************************************************
     *** methods for menu location config
     **************************************************************************
     *************************************************************************/

    public function add_menu($menu_name)
    {
        MenuLocationConfig::add_menu_location($menu_name);
    }

    public function remove_menu($menu_name)
    {
        MenuLocationConfig::remove_menu_location($menu_name);
    }

    /**************************************************************************
     **************************************************************************
     *** methods for required plugin config
     **************************************************************************
     *************************************************************************/

    public function require_plugin($plugin_name, $class_name = '')
    {
        RequiredPluginConfig::require_plugin($plugin_name, $class_name);
    }

    /**************************************************************************
     **************************************************************************
     *** methods for custom post type config
     **************************************************************************
     *************************************************************************/

    public function add_post_type($post_type, $config)
    {
        CustomPostTypeConfig::add_post_type($post_type, $config);
    }

    public function remove_post_type($post_type)
    {
        CustomPostTypeConfig::remove_post_type($post_type);
    }

    /**************************************************************************
     **************************************************************************
     *** methods for sidebar/widget location config
     **************************************************************************
     *************************************************************************/

    public function add_sidebar($sidebar_name, $description = '')
    {
        SidebarLocationConfig::add_sidebar_location($sidebar_name, $description);
    }

    public function remove_sidebar($sidebar_name)
    {
        SidebarLocationConfig::remove_sidebar_location($sidebar_name);
    }

    /**************************************************************************
     **************************************************************************
     *** methods for theme support config
     **************************************************************************
     *************************************************************************/

    public function add_support($feature)
    {
        ThemeSupportConfig::add_theme_support($feature);
    }

    public function remove_support($feature)
    {
        ThemeSupportConfig::remove_theme_support($feature);
    }
}
