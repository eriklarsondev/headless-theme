<?php
namespace wpdev;

class RequiredPluginConfig extends Base
{
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('admin_init', [$this, 'initRequiredPlugins']);
        }
    }

    public function initRequiredPlugins()
    {
        $this->isPluginActive('advanced custom fields', 'ACF');
    }

    private function isPluginActive($plugin_name, $class_name = '')
    {
        if ($class_name) {
            if (!class_exists($class_name)) {
                $this->renderNotification($plugin_name);
                return false;
            }
            return true;
        } else {
            $plugins = [];

            $installed = get_plugins();
            foreach ($installed as $plugin) {
                array_push($plugins, parent::formatLabel($plugin['Name'], ' ', false));
            }

            if (!in_array(parent::formatLabel($plugin_name, ' ', false), $plugins)) {
                $this->renderNotification($plugin_name);
                return false;
            }
            return true;
        }
    }

    private function renderNotification($plugin_name)
    {
        add_action('admin_notices', function () use ($plugin_name) {
            $url = $this->getSearchQuery($plugin_name); ?>
            <div class="notice notice-error">
                <p>
                    <strong><?php echo ucwords($plugin_name); ?></strong> was not found.
                    Click <a href="<?php echo $url; ?>">here</a> to install or activate this plugin.
                </p>
            </div>
            <?php
        });
    }

    private function getSearchQuery($plugin_name)
    {
        $query = parent::formatLabel($plugin_name, '%20', false);

        $url = admin_url('plugin-install.php') . '?s=' . $query;
        $url .= '&tab=search&type=term';

        return $url;
    }

    /**************************************************************************
     **************************************************************************
     *** static wrappers for required plugin config
     **************************************************************************
     *************************************************************************/

    static function require_plugin($plugin_name, $class_name = '')
    {
        add_action('admin_init', function () use ($plugin_name, $class_name) {
            (new self(true))->isPluginActive($plugin_name, $class_name);
        });
    }
}

new RequiredPluginConfig();
