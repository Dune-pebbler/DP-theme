<?php
// Global Settings Retrieval
$spacing_group = get_sub_field('spacing_group');
$color_group = get_sub_field('color_group');
$optimalisation_group = get_sub_field('optimalisation_group');

// Initialize variables safely
$container_size_value = null;
$background_color_value = null;
$optimalisation_value = null;

// 1. SAFE ACCESS FOR SPACING GROUP
if ($spacing_group && is_array($spacing_group)) {
    $container_size_value = $spacing_group['container_size'];
}

// 2. SAFE ACCESS FOR COLOR GROUP
if ($color_group && is_array($color_group)) {
    // ⚠️ CHECK THIS NAME CAREFULLY ⚠️
    $theme_class = $color_group['theme_picker'];
}

// 3. Conditional Class/Style Definitions

// Container Class
$container_class = $container_size_value ? 'container-fluid' : 'container';
$padding_class = $spacing_group['padding_picker'];
$theme_class = $color_group['theme_picker'];
$lazy_load_class = $optimalisation_group['lazy_load_disable'] ? 'eager' : 'lazy';
