# Dune Pebbler WordPress Theme - Project Structure Map

## Project Overview
**Theme Name:** Dune Pebbler - Custom thema
**Type:** WordPress Custom Theme
**Version:** 1.0
**Key Technologies:** PHP, SASS, ACF (Advanced Custom Fields), WooCommerce, JavaScript

## Core Theme Files (Root Level)

### Primary Template Files
- `functions.php` - Main theme functionality, hooks, and configurations
- `header.php` - Site header template
- `footer.php` - Site footer template
- `index.php` - Default fallback template
- `page.php` - Single page template
- `singular.php` - Single post/page template
- `404.php` - 404 error page template
- `search.php` - Search results template
- `child-item.php` - Child item template

### Specialized Templates
- `template-page_builder.php` - Page builder template
- `DP-login.php` - Custom login functionality
- `shop-filter-ajax.php` - WooCommerce AJAX shop filtering

### ACF Configuration Files
- `acf-fields.php` - ACF field definitions
- `acf-import.json` - ACF field import/export JSON
- `acf-styles.php` - ACF-specific styling

### Theme Metadata
- `style.css` - Theme stylesheet header with theme information
- `screenshot.jpg` - Theme screenshot for WordPress admin
- `README.md` - Project setup and git workflow instructions

## Directory Structure

### `/acf/` - Advanced Custom Fields
JSON configuration files for ACF field groups:
- `ui_options_page_665f0f0413fd1.json` - UI options page configuration
- `group_682c844bc66c1.json` - Field group configuration
- `group_68dfde7f96c4f.json` - Field group configuration
- `group_665f0f86c37e9.json` - Field group configuration

### `/template-parts/` - Reusable Template Components
Main template partials:
- `card.php` - Card component
- `searchbar.php` - Search bar component
- `video.php` - Video component

#### `/template-parts/blocks/` - ACF Block Templates
Custom Gutenberg blocks powered by ACF:
- `hero_banner.php` - Hero banner block
- `text_with_image.php` - Text with image block
- `masonry_gallery.php` - Masonry gallery block
- `image_block.php` - Custom image block
- `txt_block.php` - Text content block
- `faq_block.php` - FAQ accordion block
- `breadcrumbs_block.php` - Breadcrumbs navigation block
- `global-settings.php` - Global block settings

### `/sass/` - SASS Stylesheets (Source)
Main SASS entry point:
- `main.scss` - Main SASS compilation file
- `_global-settings.scss` - Global style settings

#### `/sass/abstracts/` - SASS Variables & Helpers
- `_variables.scss` - SASS variables (colors, fonts, etc.)
- `_mixins.scss` - Reusable SASS mixins
- `_functions.scss` - SASS functions
- `_bootstrap.scss` - Bootstrap integration

#### `/sass/base/` - Base Styles
- `_typography.scss` - Typography styles

#### `/sass/blocks/` - Block-Specific Styles
Matches `/template-parts/blocks/` structure:
- `_hero_banner.scss` - Hero banner styles
- `_text_with_image.scss` - Text with image styles
- `_masonry_gallery.scss` - Masonry gallery styles
- `_image_block.scss` - Image block styles
- `_txt_block.scss` - Text block styles
- `_faq_block.scss` - FAQ block styles
- `_breadcrumbs.scss` - Breadcrumbs styles

#### `/sass/modules/` - Component Modules
- `_header.scss` - Header styles
- `_footer.scss` - Footer styles
- `_buttons.scss` - Button styles
- `_card.scss` - Card component styles
- `_searchbar.scss` - Search bar styles
- `_socials.scss` - Social media styles
- `_form.scss` - Form styles

#### `/sass/pages/` - Page-Specific Styles
- `_404.scss` - 404 page styles

#### `/sass/utilities/` - Utility Classes
- `_general.scss` - General utilities
- `_flexbox.scss` - Flexbox utilities
- `_flexboxv2.scss` - Enhanced flexbox utilities
- `_grid.scss` - Grid system
- `_spacings.scss` - Spacing utilities
- `_images.scss` - Image utilities
- `_blocksettings.scss` - Block-specific utilities

#### `/sass/woocommerce/` - WooCommerce Styles
- `_shop-archive.scss` - Shop archive page styles

#### `/sass/animations/` - Animation Styles
Animation definitions

#### `/sass/vendor/` - Third-Party SASS
Vendor-specific SASS files

### `/stylesheets/` - Compiled CSS (Output)
Compiled CSS files from SASS:
- `main.css` - Main compiled stylesheet
- `main.css.map` - Source map for main.css
- `bootstrap-grid.css` - Bootstrap grid CSS
- `bootstrap-grid.css.map` - Source map for Bootstrap grid

#### `/stylesheets/admin/` - WordPress Admin Styles
- `style.css` - Admin area styles
- `login.css` - Login page styles

### `/js/` - JavaScript Files
- `main.js` - Main JavaScript entry point

#### `/js/libs/` - JavaScript Libraries
- `masonry.js` - Masonry grid library
- `in-view.js` - Viewport visibility library
- `google-maps-loader.js` - Google Maps integration

### `/assets/` - External Assets & Libraries
Third-party assets and libraries:
- `/assets/fontawesome/` - Font Awesome icon library
- `/assets/fancybox/` - Fancybox lightbox library
- `/assets/owlcarousel/` - Owl Carousel slider library

### `/images/` - Theme Images
Image assets for the theme:
- `/images/login/` - Login page images

### `/.github/` - GitHub Configuration
- `/.github/workflows/` - GitHub Actions workflows

## Key Patterns & Conventions

### ACF Blocks
1. PHP template in `/template-parts/blocks/{block_name}.php`
2. Corresponding SASS in `/sass/blocks/_{block_name}.scss`
3. Register blocks in `functions.php`
4. ACF field configurations in `/acf/` directory

### Styling Workflow
1. Edit SASS files in `/sass/` directory
2. SASS compiles to `/stylesheets/main.css`
3. Main SASS imports organized by: abstracts → base → utilities → modules → blocks → pages

### Template Hierarchy
1. Root level PHP files are primary templates
2. `/template-parts/` contains reusable components
3. `/template-parts/blocks/` contains ACF Gutenberg blocks

### JavaScript Structure
1. Main JS in `/js/main.js`
2. External libraries in `/js/libs/`
3. Enqueued via `functions.php`

## Common File Locations

### Need to modify styles?
- **Variables/Colors:** `/sass/abstracts/_variables.scss`
- **Typography:** `/sass/base/_typography.scss`
- **Header:** `/sass/modules/_header.scss`
- **Footer:** `/sass/modules/_footer.scss`
- **Specific block:** `/sass/blocks/_{block-name}.scss`
- **Utilities:** `/sass/utilities/`

### Need to modify templates?
- **Header:** `header.php`
- **Footer:** `footer.php`
- **Single page:** `page.php`
- **404 page:** `404.php`
- **Blocks:** `/template-parts/blocks/`
- **Components:** `/template-parts/`

### Need to modify functionality?
- **Theme functions:** `functions.php`
- **ACF fields:** `acf-fields.php` or `/acf/` JSON files
- **Shop filters:** `shop-filter-ajax.php`

### Need to modify JavaScript?
- **Main JS:** `/js/main.js`
- **Add library:** `/js/libs/`

## WooCommerce Integration
- Shop filtering: `shop-filter-ajax.php`
- Shop styles: `/sass/woocommerce/_shop-archive.scss`
- Configured via `functions.php`

## Development Workflow
- SASS compilation required for style changes
- ACF fields can be imported via `acf-import.json`
- GitHub workflows available in `.github/workflows/`
- Follow git workflow documented in `README.md`
