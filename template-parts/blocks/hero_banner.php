<?php
$hero_banner_image = get_sub_field('hero_banner_img');
$hero_banner_title = get_sub_field('hero_banner_title');
@require 'global-settings.php';
?>
<section class="hero_banner <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <div class="col-12 p-0">
                <div class="hero_banner__content-container">
                    <?php if ($hero_banner_title): ?>
                        <div class="hero_banner__title-container">
                            <h1><?= $hero_banner_title; ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php if ($hero_banner_image): ?>
                        <div class="hero_banner__image-container">
                            <img src="<?= $hero_banner_image['url']; ?>" alt="<?= $hero_banner_image['alt']; ?>"
                                loading="<?= $lazy_load_class; ?>">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>