# DP-theme WordPress Theme - Project Documentation

## Project Overview
This is a custom WordPress theme for Dune Pebbler with a flexible page builder system using ACF (Advanced Custom Fields).

## Architecture

### Block System
The theme uses a flexible content block system powered by ACF flexible fields:
- Blocks are defined in ACF JSON files in `/acf/`
- Block templates are located in `/template-parts/blocks/`
- The page builder template is `template-page_builder.php`

### Current Blocks
1. **hero_banner** - Hero banner block
2. **hero_block** - Hero block
3. **hero_slider_block** - Hero slider with carousel
4. **hero_video_block** - Hero with video background
5. **text_with_image** - Text with image block
6. **txt_block** - Text only block
7. **image_block** - Image block
8. **faq_block** - FAQ accordion block
9. **masonry_gallery** - Masonry gallery layout
10. **breadcrumbs_block** - Breadcrumbs navigation
11. **archive_block** - Archive/post listing with AJAX search and load more
12. **logo_slider_block** - Logo slider carousel
13. **contact_block** - Contact form block
14. **google_maps_block** - Google Maps integration
15. **recent_posts_block** - Recent posts display with flexible post type selection

### File Structure
```
DP-theme/
├── acf/                          # ACF field groups (JSON)
│   ├── group_682c844bc66c1.json  # Main pagebuilder field group
│   └── ...
├── template-parts/
│   ├── blocks/                   # Block PHP templates
│   │   ├── global-settings.php   # Global block settings (padding, theme, container)
│   │   └── [block-name].php      # Individual block templates
│   └── modules/                  # Reusable components
├── sass/
│   ├── blocks/                   # Block-specific SCSS files
│   └── utilities/                # Utility SCSS
├── stylesheets/                  # Compiled CSS
├── js/                           # JavaScript files
├── functions.php                 # Theme functions and hooks
└── template-page_builder.php    # Page builder template
```

### Adding New Blocks

To add a new block, you need to:

1. **Create Block Template** (`/template-parts/blocks/[block-name].php`)
   - Use `get_sub_field()` to retrieve ACF fields
   - Include `global-settings.php` for consistent block settings
   - Use Bootstrap grid classes (`container-fluid`, `row`, `col-*`)

2. **Create Block Styles** (`/sass/blocks/_[block-name].scss`)
   - Follow BEM naming convention
   - Use the block name as namespace
   - Import in main SCSS file

3. **Update ACF Field Group** (`/acf/group_682c844bc66c1.json`)
   - Add new layout to the `pagebuilder` flexible content field
   - Define required fields for the block
   - ACF will auto-save JSON when fields are edited in WP admin

4. **Register in Page Builder** (`template-page_builder.php`)
   - Add conditional check for `get_row_layout() === 'block_name'`
   - Include block template with `get_template_part()`

5. **Add AJAX handlers if needed** (`functions.php`)
   - Register AJAX actions
   - Implement handler functions
   - Enqueue necessary scripts

### Global Block Settings
Every block can include these standard settings (via `global-settings.php`):
- **Theme Color**: Primary, secondary, tertiary, white, black
- **Container Type**: Full width or contained
- **Padding**: None, small, medium, large

### Styling Guidelines
- Use SCSS, not CSS
- Compiled CSS goes to `/stylesheets/main.css`
- CSS variables are defined in functions.php via ACF options (`my_theme_global_settings()`)
- Use BEM naming: `.block-name__element--modifier`

### AJAX Functionality
The theme includes AJAX handlers for:
- Archive block search
- Archive block load more pagination
- Nonce verification for security

### Theme Functions
Key functions in `functions.php`:
- `my_theme_global_settings()` - Outputs CSS variables from ACF options
- `get_contrast_color()` - Calculates text color based on background
- `darken_color()` - Darkens colors for hover states
- `handle_archive_block_search()` - AJAX search handler
- `handle_archive_block_load_more()` - AJAX pagination handler

### ACF Configuration
- JSON save/load point: `/acf/`
- Google Maps API key configured
- Block editor disabled in favor of page builder

### Important Notes
- Always use `.scss` files, never edit `.css` directly
- ACF field groups auto-sync from JSON
- Bootstrap grid system is used throughout
- FontAwesome icons available
- jQuery, Owl Carousel, and Fancybox included
