<?php
$spacing_group = get_sub_field('spacing_group');
$color_group = get_sub_field('color_group');
$optimalisation_group = get_sub_field('optimalisation_group');
$container_size_value = null;
$background_color_value = null;
$optimalisation_value = null;
if ($spacing_group && is_array($spacing_group)) {
    $container_size_value = $spacing_group['container_size'];
}
if ($color_group && is_array($color_group)) {
    $theme_class = $color_group['theme_picker'];
}

$container_class = $container_size_value ? 'container-fluid' : 'container';
$padding_class = $spacing_group['padding_picker'];
$theme_class = $color_group['theme_picker'];
$lazy_load_class = $optimalisation_group['lazy_load_disable'] ? 'eager' : 'lazy';
