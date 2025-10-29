<?php
defined("ABSPATH") || die("-1");

# DEFINES
define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_TD', sanitize_title(get_bloginfo("title")));

# REQUIRES
// include(get_template_directory() . '/shortcodes/shortcodes.php');
// include(get_template_directory() . '/custom-blocks.php');
include(get_template_directory() . '/DP-login.php');
// include(get_template_directory() . '/acf-fields.php');


// include(get_template_directory() . '/shop-filter-ajax.php');

# ACTIONS
add_action('admin_enqueue_scripts', 'my_custom_admin_styles');
add_action('login_enqueue_scripts', 'ds_admin_theme_style');
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
// add_action('acf/init', 'my_acf_init');
add_action('admin_menu', 'remove_dashboard_comments');

//theme colors as css root variables
add_action('wp_head', 'my_theme_global_settings');

# FILTERS
add_filter('wp_page_menu_args', 'home_page_menu_args');
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10);
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'remove_thumbnail_dimensions', 10);
add_filter('the_content', 'add_image_responsive_class');
add_filter('upload_mimes', 'cc_mime_types');
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
add_filter('acf/settings/load_json', 'my_acf_json_load_point');
add_filter('use_block_editor_for_post_type', '__return_false', 10);
add_filter('use_widgets_block_editor', '__return_false');

// add_filter('use_block_editor_for_post', '__return_false');

# THEME SUPPORTS
add_theme_support('menus');
add_theme_support('post-thumbnails'); // array for post-thumbnail support on certain post-types.
// add_theme_support('woocommerce'); // array for post-thumbnail support on certain post-types.

# IMAGE SIZES
add_image_size('default-thumbnail', 128, 128, true); // true: hard crop or empty if soft crop
add_image_size('full', 0, 0, false);
set_post_thumbnail_size(128, 128, true);

register_nav_menus(array(
  'primary' => __('Primary Menu', THEME_TD),
  'footer' => __('Footer Menu', THEME_TD),
));

#DISABLES DASHBOARD AND REACTIONS


# FUNCTIONS
function remove_dashboard_comments()
{
  remove_menu_page('index.php');
  remove_menu_page('edit-comments.php');
  add_action('admin_bar_menu', function ($wp_admin_bar) {
    $wp_admin_bar->remove_node('comments');
  }, 999);
  add_action('load-index.php', function () {
    wp_redirect(admin_url('edit.php'));
    exit;
  });
}

function theme_enqueue_styles()
{
  wp_enqueue_style('fontawesome.all.min.js', get_template_directory_uri() . "/assets/fontawesome/css/all.min.css");
  wp_enqueue_style('theme-jquery.fancybox.min.css', get_template_directory_uri() . "/assets/fancybox/jquery.fancybox.min.css");
  wp_enqueue_style('owl.carousel.min.css', get_template_directory_uri() . "/assets/owlcarousel/owl.carousel.min.css");
  wp_enqueue_style('owl.carousel.default.theme.min.css', get_template_directory_uri() . "/assets/owlcarousel/owl.theme.default.min.css");
  wp_enqueue_style('bootstrap-grid', get_template_directory_uri() . "/stylesheets/bootstrap-grid.css");
  wp_enqueue_style('styles-main', get_template_directory_uri() . "/stylesheets/main.css", [], filemtime(get_template_directory() . "/stylesheets/main.css"));
}
function theme_enqueue_scripts()
{
  # Libs
  wp_enqueue_script('js-in-view', get_template_directory_uri() . "/js/libs/in-view.js", ['jquery'], '1.0.0', true);
  wp_enqueue_script('google-maps-loader', get_template_directory_uri() . "/js/libs/google-maps-loader.js", ['jquery'], '1.0.0', true);
  wp_enqueue_script('js-masonry', get_template_directory_uri() . "/js/libs/masonry.js", ['jquery'], '1.0.0', true);
  # Assets
  wp_enqueue_script('jquery.fancybox.min.js', get_template_directory_uri() . "/assets/fancybox/jquery.fancybox.min.js", ['jquery'], '1.0.0', true);
  wp_enqueue_script('owl.carousel.min.js', get_template_directory_uri() . "/assets/owlcarousel/owl.carousel.min.js", ['jquery'], '1.0.0', true);
  # Functions
  wp_enqueue_script('js-main', get_template_directory_uri() . "/js/main.js", ['jquery'], filemtime(get_template_directory() . "/js/main.js"), true);
  wp_enqueue_script('init-map', get_template_directory_uri() . '/js/init-map.js', array('google-maps-loader'), '1.0.0', true);

  // Localize script for AJAX
  wp_localize_script('js-main', 'ajax_object', array(
    'ajax_url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('archive_block_nonce')
  ));
}



function my_custom_admin_styles()
{
  wp_enqueue_style('custom-admin-style', get_stylesheet_directory_uri() . '/stylesheets/admin/style.css', false, '1.0.0');
}
function my_acf_json_save_point($path)
{
  $path = get_stylesheet_directory() . '/acf';
  return $path;
}
function my_acf_json_load_point($paths)
{
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/acf';
  return $paths;
}
function home_page_menu_args($args)
{
  $args['show_home'] = true;
  return $args;
}
function remove_thumbnail_dimensions($html)
{
  $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
  return $html;
}
function remove_width_attribute($html)
{
  $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
  return $html;
}
function add_image_responsive_class($content)
{
  global $post;
  $pattern = "/<img(.*?)class=\"(.*?)\"(.*?)>/i";
  $replacement = '<img$1class="$2 img-responsive"$3>';
  $content = preg_replace($pattern, $replacement, $content);
  return $content;
}
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
function ds_admin_theme_style()
{
  if (!current_user_can('manage_options')) {
    echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';
  }
}
function my_theme_global_settings()
{
  $global_colors_group = get_field('site_settings_global_colors', 'option');
  if ($global_colors_group) {
    $primary_color = $global_colors_group['site_settings_primary_kleur'];
    $secondary_color = $global_colors_group['site_settings_secondary_kleur'];
    $tertiary_color = $global_colors_group['site_settings_tertiar_kleur'];
    $black = $global_colors_group['site_settings_black'];
    $white = $global_colors_group['site_settings_wit'];
  }

  $text_colors_group = get_field('site_settings_text_colors', 'option');
  if ($text_colors_group) {
    $paragraph_color = $text_colors_group['site_settings_text_colors_paragraph'];
    $title_color = $text_colors_group['site_settings_text_colors_title'];
    $link_color = $text_colors_group['site_settings_text_colors_link'];
  }

  $button_colors_group = get_field('site_settings_button_colors', 'option');
  if ($button_colors_group) {
    $button_primary_color = $button_colors_group['site_settings_button_primary_color'];
    $button_secondary_color = $button_colors_group['site_settings_button_secondary_color'];
    $button_outline_color = $button_colors_group['site_settings_button_outline_color'];
  }

  $button_style_group = get_field('site_settings_button_style', 'option');
  if ($button_style_group) {
    $button_border_radius = $button_style_group['site_settings_button_border_radius'];
  }

  ?>

  <style>
    :root {
      --primary-color:
        <?php echo esc_attr($primary_color); ?>
      ;
      --secondary-color:
        <?php echo esc_attr($secondary_color); ?>
      ;
      --tertiary-color:
        <?php echo esc_attr($tertiary_color); ?>
      ;
      --black:
        <?php echo esc_attr($black); ?>
      ;
      --white:
        <?php echo esc_attr($white); ?>
      ;

      --paragraph-color:
        <?php echo esc_attr($paragraph_color); ?>
      ;
      --title-color:
        <?php echo esc_attr($title_color); ?>
      ;
      --link-color:
        <?php echo esc_attr($link_color); ?>
      ;

      --button-primary-color:
        <?php echo esc_attr($button_primary_color); ?>
      ;
      --button-secondary-color:
        <?php echo esc_attr($button_secondary_color); ?>
      ;
      --button-outline-color:
        <?php echo esc_attr($button_outline_color); ?>
      ;

      --button-primary-text-color:
        <?php echo get_contrast_color(esc_attr($button_primary_color)); ?>
      ;
      --button-secondary-text-color:
        <?php echo get_contrast_color(esc_attr($button_secondary_color)); ?>
      ;
      --button-outline-text-color:
        <?php echo get_contrast_color(esc_attr($button_outline_color)); ?>
      ;

      --button-primary-hover-color:
        <?php echo darken_color(esc_attr($button_primary_color)); ?>
      ;
      --button-secondary-hover-color:
        <?php echo darken_color(esc_attr($button_secondary_color)); ?>
      ;
      --button-outline-hover-color:
        <?php echo darken_color(esc_attr($button_outline_color)); ?>
      ;

      --button-border-radius:
        <?php echo esc_attr($button_border_radius) . 'px'; ?>
      ;
    }
  </style>
  <?php
}
function get_contrast_color($color)
{
  list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
  $luminance = 0.2126 * pow($r / 255, 2.2) + 0.7152 * pow($g / 255, 2.2) + 0.0722 * pow($b / 255, 2.2);
  return ($luminance > 0.5) ? '#292929' : '#ffffff';
}

function darken_color($color)
{
  $percentage = 10;

  list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
  $percentage = 1 - ($percentage / 100);
  $r *= $percentage;
  $g *= $percentage;
  $b *= $percentage;
  // Ensure values are within range
  $r = max(0, min(255, $r));
  $g = max(0, min(255, $g));
  $b = max(0, min(255, $b));
  return sprintf("#%02x%02x%02x", $r, $g, $b);
}
function my_acf_google_map_api($api)
{
  $api['key'] = 'AIzaSyAFnp43058d47C4IkMcQi5LD8EpjLGSqro';
  return $api;
}
# Random code
$role_object = get_role('editor');
$role_object->add_cap('edit_theme_options');

// Archive Block AJAX handlers
add_action('wp_ajax_archive_block_search', 'handle_archive_block_search');
add_action('wp_ajax_nopriv_archive_block_search', 'handle_archive_block_search');
add_action('wp_ajax_archive_block_load_more', 'handle_archive_block_load_more');
add_action('wp_ajax_nopriv_archive_block_load_more', 'handle_archive_block_load_more');

function handle_archive_block_search()
{
  // Verify nonce
  if (!wp_verify_nonce($_POST['nonce'], 'archive_block_nonce')) {
    wp_die('Security check failed');
  }

  $post_type = sanitize_text_field($_POST['post_type']);
  $posts_per_page = intval($_POST['posts_per_page']);
  $page = intval($_POST['page']);
  $search = sanitize_text_field($_POST['search']);

  $args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
    'paged' => $page,
    'post_status' => 'publish',
    's' => $search
  );

  $query = new WP_Query($args);

  $html = '';
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $html .= get_archive_post_card_html(get_the_ID(), $post_type);
    }
  }

  wp_reset_postdata();

  wp_send_json_success(array(
    'html' => $html,
    'current_count' => $query->post_count,
    'total_count' => $query->found_posts,
    'has_more' => $query->max_num_pages > $page
  ));
}

function handle_archive_block_load_more()
{
  // Verify nonce
  if (!wp_verify_nonce($_POST['nonce'], 'archive_block_nonce')) {
    wp_die('Security check failed');
  }

  $post_type = sanitize_text_field($_POST['post_type']);
  $posts_per_page = intval($_POST['posts_per_page']);
  $page = intval($_POST['page']);
  $search = sanitize_text_field($_POST['search']);

  $args = array(
    'post_type' => $post_type,
    'posts_per_page' => $posts_per_page,
    'paged' => $page,
    'post_status' => 'publish',
    's' => $search
  );

  $query = new WP_Query($args);

  $html = '';
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $html .= get_archive_post_card_html(get_the_ID(), $post_type);
    }
  }

  wp_reset_postdata();

  wp_send_json_success(array(
    'html' => $html,
    'current_count' => $query->post_count,
    'total_count' => $query->found_posts,
    'has_more' => $query->max_num_pages > $page
  ));
}

function get_archive_post_card_html($post_id, $post_type)
{
  $post = get_post($post_id);
  $permalink = get_permalink($post_id);
  $title = get_the_title($post_id);
  $excerpt = get_the_excerpt($post_id);
  $date = get_the_date('', $post_id);
  $thumbnail_url = get_the_post_thumbnail_url($post_id, 'medium');

  $html = '<div class="archive_block__post-card" data-post-id="' . $post_id . '">';

  // Image
  $html .= '<div class="archive_block__card-image">';
  if ($thumbnail_url) {
    $html .= '<img src="' . $thumbnail_url . '" alt="' . esc_attr($title) . '" loading="lazy">';
  } else {
    $html .= '<div class="archive_block__placeholder-image"><i class="fas fa-image"></i></div>';
  }
  $html .= '</div>';

  // Content
  $html .= '<div class="archive_block__card-content">';
  $html .= '<h3 class="archive_block__card-title"><a href="' . $permalink . '">' . $title . '</a></h3>';

  // Meta
  $html .= '<div class="archive_block__card-meta">';
  $html .= '<span class="archive_block__card-date">' . $date . '</span>';

  // if ($post_type === 'post') {
  //   $categories = get_the_category($post_id);
  //   if ($categories) {
  //     $html .= '<span class="archive_block__card-category">' . $categories[0]->name . '</span>';
  //   }
  // }
  $html .= '</div>';

  // Excerpt
  $html .= '<div class="archive_block__card-excerpt">' . wp_trim_words($excerpt, 20, '...') . '</div>';

  // Link
  $html .= '<a href="' . $permalink . '" class="archive_block__card-link">Lees meer <i class="fas fa-arrow-right"></i></a>';

  $html .= '</div>';
  $html .= '</div>';

  return $html;
}
