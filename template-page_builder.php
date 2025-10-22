<?php
/*
 * Template Name: Page Builder
 * Template Post Type: page, post
 */

get_header(); ?>

<?php if (have_rows('pagebuilder')): ?>
        <?php while (have_rows('pagebuilder')):
                the_row(); ?>
                <?php if (get_row_layout() === 'hero_banner'): ?>
                        <?php get_template_part('template-parts/blocks/hero_banner'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'text_with_image'): ?>
                        <?php get_template_part('template-parts/blocks/text_with_image'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'txt_block'): ?>
                        <?php get_template_part('template-parts/blocks/txt_block'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'image_block'): ?>
                        <?php get_template_part('template-parts/blocks/image_block'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'faq_block'): ?>
                        <?php get_template_part('template-parts/blocks/faq_block'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'masonry_gallery'): ?>
                        <?php get_template_part('template-parts/blocks/masonry_gallery'); ?>
                <?php endif; ?>

                <?php if (get_row_layout() === 'breadcrumbs_block'): ?>
                        <?php get_template_part('template-parts/blocks/breadcrumbs_block'); ?>
                <?php endif; ?>
        <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>