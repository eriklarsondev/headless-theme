<?php
namespace wpdev;

class ExcerptConfig
{
    public function __construct()
    {
        add_filter('excerpt_length', [$this, 'initExcerptLength']);
        add_filter('excerpt_more', [$this, 'initExcerptReadMore']);
    }

    public function initExcerptLength($length)
    {
        return 30;
    }

    public function initExcerptReadMore($more)
    {
        global $post;
        return '...';
    }
}

new ExcerptConfig();
