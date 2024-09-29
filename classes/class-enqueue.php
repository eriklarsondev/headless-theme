<?php
namespace wpdev;

class FileEnqueueConfig extends Base
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'initStylesheets']);
        add_action('wp_footer', [$this, 'initDeferredStylesheets']);
    }

    public function initStylesheets()
    {
        $dirpath = dirname(get_template_directory_uri()) . '/dist';

        $this->removeStylesheet('wp emoji styles');
        $this->removeStylesheet('wp block library');
        $this->removeStylesheet('classic theme styles');
        $this->removeStylesheet('global styles');
    }

    public function initDeferredStylesheets()
    {
        $dirpath = dirname(get_template_directory_uri()) . '/dist';

        $this->addStylesheet('theme styles', $dirpath . '/css/main.css');
    }

    private function addStylesheet($name, $path, $deps = [], $vers = '0.1.0')
    {
        $id = parent::formatLabel($name, '-');

        if (count($deps)) {
            for ($i = 0; $i < count($deps); $i++) {
                $deps[$i] = parent::formatLabel($deps[$i], '-');
            }
        }
        wp_register_style($id, $path, $deps, $vers);
        wp_enqueue_style($id);
    }

    private function removeStylesheet($name, $prefix = false)
    {
        $id = parent::formatLabel($name, '-', $prefix);
        wp_deregister_style($id);
        wp_dequeue_style($id);
    }
}

new FileEnqueueConfig();
