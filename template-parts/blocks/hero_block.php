<?php
$hero_block_image = get_sub_field('hero_block_image');
$hero_block_description = get_sub_field('hero_block_description');
$hero_block_button = get_sub_field('hero_block_button');
$hero_block_text_position = get_sub_field('hero_block_text_position');
$hero_block_text_color = get_sub_field('hero_block_text_color');
$hero_block_overlay_color = get_sub_field('hero_block_overlay_color');
$hero_block_overlay_opacity = get_sub_field('hero_block_overlay_opacity');

@require 'global-settings.php';
?>
<section class="hero_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <div class="col-12 p-0">
                <div class="hero_block__container">
                    <?php if ($hero_block_image): ?>
                        <div class="hero_block__image-container">
                            <img src="<?= $hero_block_image['url']; ?>" alt="<?= $hero_block_image['alt']; ?>"
                                loading="<?= $lazy_load_class; ?>">
                        </div>
                    <?php endif; ?>

                    <?php if ($hero_block_overlay_color || $hero_block_overlay_opacity): ?>
                        <div class="hero_block__overlay"
                            style="<?= $hero_block_overlay_color ? 'background-color: ' . $hero_block_overlay_color . ';' : ''; ?> 
                                    <?= $hero_block_overlay_opacity ? 'opacity: ' . $hero_block_overlay_opacity . ';' : ''; ?>">
                        </div>
                    <?php endif; ?>

                    <div class="hero_block__content hero_block__content--<?= $hero_block_text_position ?: 'center'; ?>">
                        <div class="hero_block__text-container"
                            style="<?= $hero_block_text_color ? 'color: ' . $hero_block_text_color . ';' : ''; ?>">
                            <?php if ($hero_block_description): ?>
                                <div class="hero_block__description">
                                    <?= $hero_block_description; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($hero_block_button): ?>
                                <div class="hero_block__button">
                                    <a href="<?= $hero_block_button['url']; ?>" class="btn-hero"
                                        <?= $hero_block_button['target'] ? 'target="' . $hero_block_button['target'] . '"' : ''; ?>>
                                        <?= $hero_block_button['title']; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>