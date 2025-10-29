<?php
$hero_slider_slides = get_sub_field('hero_slider_slides');
$hero_slider_text_position = get_sub_field('hero_slider_text_position');
$hero_slider_overlay_color = get_sub_field('hero_slider_overlay_color');
$hero_slider_overlay_opacity = get_sub_field('hero_slider_overlay_opacity');
$hero_slider_autoplay = get_sub_field('hero_slider_autoplay');
$hero_slider_autoplay_speed = get_sub_field('hero_slider_autoplay_speed');

@require 'global-settings.php';
?>
<section class="hero_slider_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <div class="col-12 p-0">
                <div class="hero_slider_block__container">
                    <?php if ($hero_slider_slides): ?>
                        <div class="hero_slider_block__slider owl-carousel"
                            data-autoplay="<?= $hero_slider_autoplay ? 'true' : 'false'; ?>"
                            data-autoplay-speed="<?= $hero_slider_autoplay_speed ?: 5000; ?>">
                            <?php foreach ($hero_slider_slides as $slide): ?>
                                <div class="hero_slider_block__slide">
                                    <?php if ($slide['slide_image']): ?>
                                        <div class="hero_slider_block__image-container">
                                            <img src="<?= $slide['slide_image']['url']; ?>"
                                                alt="<?= $slide['slide_image']['alt']; ?>" loading="<?= $lazy_load_class; ?>">
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($hero_slider_overlay_color || $hero_slider_overlay_opacity): ?>
                                        <div class="hero_slider_block__overlay"
                                            style="<?= $hero_slider_overlay_color ? 'background-color: ' . $hero_slider_overlay_color . ';' : ''; ?> 
                                                    <?= $hero_slider_overlay_opacity ? 'opacity: ' . $hero_slider_overlay_opacity . ';' : ''; ?>">
                                        </div>
                                    <?php endif; ?>

                                    <div
                                        class="hero_slider_block__content hero_slider_block__content--<?= $hero_slider_text_position ?: 'center'; ?>">
                                        <div class="hero_slider_block__text-container"
                                            style="<?= $slide['slide_text_color'] ? 'color: ' . $slide['slide_text_color'] . ';' : ''; ?>">
                                            <?php if ($slide['slide_description']): ?>
                                                <div class="hero_slider_block__description">
                                                    <?= $slide['slide_description']; ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($slide['slide_button']): ?>
                                                <div class="hero_slider_block__button">
                                                    <a href="<?= $slide['slide_button']['url']; ?>" class="btn-hero"
                                                        <?= $slide['slide_button']['target'] ? 'target="' . $slide['slide_button']['target'] . '"' : ''; ?>>
                                                        <?= $slide['slide_button']['title']; ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>