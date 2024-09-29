<!DOCTYPE html>

<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <?php wp_head(); ?>
    <style>
        html {
            visibility: hidden;
            opacity: 0;
        }
    </style>
</head>

<body <?php body_class(); ?>>
