<?php
namespace wpdev;

class EditorConfig extends Base
{
    public function __construct()
    {
        // disable gutenberg editor
        add_filter('use_block_editor_for_post', '__return_false');
    }
}

new EditorConfig();
