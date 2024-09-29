<?php
namespace wpdev;

class SidebarLocationConfig extends Base
{
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('init', [$this, 'initSidebarLocations']);
        }
    }

    public function initSidebarLocations()
    {
        $this->addSidebarLocation('sidebar left');
        $this->addSidebarLocation('sidebar right');
    }

    private function addSidebarLocation($sidebar_name, $description = '')
    {
        $id = parent::formatLabel($sidebar_name);

        $args = [
            'name' => ucwords($sidebar_name),
            'id' => $id,
            'description' => $description
        ];
        register_sidebar($args);
    }

    private function removeSidebarLocation($sidebar_name)
    {
        $id = parent::formatLabel($id);
        unregister_sidebar($id);
    }

    /**************************************************************************
     **************************************************************************
     *** static wrappers for sidebar/widget location config
     **************************************************************************
     *************************************************************************/

    static function add_sidebar_location($sidebar_name, $description = '')
    {
        add_action('init', function () use ($sidebar_name, $description) {
            (new self(true))->addSidebarLocation($sidebar_name, $description);
        });
    }

    static function remove_sidebar_location($sidebar_name)
    {
        add_action('init', function () use ($sidebar_name) {
            (new self(true))->removeSidebarLocation($sidebar_name);
        });
    }
}

new SidebarLocationConfig();
