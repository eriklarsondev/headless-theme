<?php
namespace wpdev;

class CustomPostTypeConfig extends Base
{
    public function __construct($static = false)
    {
        if (!$static) {
            add_action('init', [$this, 'initCustomPostTypes']);
        }
    }

    public function initCustomPostTypes()
    {
    }

    private function addPostType($post_type, $config)
    {
        $id = parent::formatLabel($post_type);

        $args = [
            'can_export' => true,
            'capability_type' => 'post',
            'delete_with_user' => false,
            'description' => isset($config->description) ? $config->description : null,
            'exclude_from_search' => false,
            'has_archive' => false,
            'hierarchical' => false,
            'labels' => $this->getPostTypeLabels(
                $post_type,
                isset($config->collection) ? $config->collection : null
            ),
            'menu_icon' => isset($config->icon)
                ? parent::formatLabel($config->icon, '-', false)
                : 'dashicons-admin-plugins',
            'menu_position' => isset($config->order) ? (int) $config->order : null,
            'public' => true,
            'publicly_queryable' => false,
            'query_var' => $id,
            'rest_base' => isset($config->collection)
                ? parent::formatLabel($config->collection, '-', false)
                : parent::formatLabel($post_type . 's', '-', false),
            'rest_namespace' => 'collections',
            'rewrite' => [
                'slug' => isset($config->collection)
                    ? '/collections/' . parent::formatLabel($config->collection, '-', false)
                    : '/collections/' . parent::formatLabel($post_type . 's', '-', false)
            ],
            'show_in_admin_bar' => false,
            'show_in_menu' => true,
            'show_in_nav_menus' => false,
            'show_in_rest' => true,
            'show_ui' => true,
            'supports' => $this->getPostTypeFeatures(
                isset($config->features) ? $config->features : null
            ),
            'taxonomies' =>
                isset($config->categories) && (bool) $config->categories === true
                    ? ['category']
                    : []
        ];
        register_post_type($id, $args);
    }

    private function removePostType($post_type)
    {
        $id = parent::formatLabel($post_type);
        unregister_post_type($id);
    }

    private function getPostTypeLabels($post_type, $collection = '')
    {
        if (!$collection) {
            $collection = $post_type . 's';
        }
        return ['name' => ucwords($collection), 'singular' => ucwords($post_type)];
    }

    private function getPostTypeFeatures($features = [])
    {
        if (!$features) {
            return ['title', 'editor'];
        }
        return $features;
    }

    /**************************************************************************
     **************************************************************************
     *** static wrappers for custom post type config
     **************************************************************************
     *************************************************************************/

    static function add_post_type($post_type, $config)
    {
        add_action('init', function () use ($post_type, $config) {
            (new self(true))->addPostType($post_type, $config);
        });
    }

    static function remove_post_type($post_type)
    {
        add_action('init', function () use ($post_type) {
            (new self(true))->removePostType($post_type);
        });
    }
}

new CustomPostTypeConfig();
