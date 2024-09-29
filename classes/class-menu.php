<?php
namespace wpdev;

class MenuLocationConfig extends Base
{
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('init', [$this, 'initMenuLocations']);
        }
    }

    public function initMenuLocations()
    {
        $this->addMenuLocation('header menu');
        $this->addMenuLocation('social media bar');
    }

    private function addMenuLocation($menu_name)
    {
        $id = parent::formatLabel($menu_name);
        register_nav_menu($id, __(ucwords($menu_name), $id));
    }

    private function removeMenuLocation($menu_name)
    {
        $id = parent::formatLabel($menu_name);
        unregister_nav_menu($id);
    }

    /**************************************************************************
     **************************************************************************
     *** static wrappers for menu location config
     **************************************************************************
     *************************************************************************/

    static function add_menu_location($menu_name)
    {
        add_action('init', function () use ($menu_name) {
            (new self(true))->addMenuLocation($menu_name);
        });
    }

    static function remove_menu_location($menu_name)
    {
        add_action('init', function () use ($menu_name) {
            (new self(true))->removeMenuLocation($menu_name);
        });
    }
}

new MenuLocationConfig();
