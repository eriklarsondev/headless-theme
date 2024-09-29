<?php
namespace wpdev;

class ThemeSupportConfig extends Base
{
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('after_setup_theme', [$this, 'initThemeSupport']);
        }
    }

    public function initThemeSupport()
    {
        $this->addThemeSupport('custom logo');
        $this->addThemeSupport('post thumbnails');
        $this->addThemeSupport('title tag');

        $this->removeThemeSupport('widgets block editor');
    }

    private function addThemeSupport($feature)
    {
        $id = parent::formatLabel($feature, '-', false);
        add_theme_support($id);
    }

    private function removeThemeSupport($feature)
    {
        $id = parent::formatLabel($feature, '-', false);
        remove_theme_support($id);
    }

    /**************************************************************************
     **************************************************************************
     *** static wrappers for theme support config
     **************************************************************************
     *************************************************************************/

    static function add_theme_support($feature)
    {
        add_action('after_setup_theme', function () use ($feature) {
            (new self(true))->addThemeSupport($feature);
        });
    }

    static function remove_theme_support($feature)
    {
        add_action('init', function () use ($feature) {
            (new self(true))->removeThemeSupport($feature);
        });
    }
}

new ThemeSupportConfig();
