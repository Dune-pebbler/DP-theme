<?php
$image_block_image = get_sub_field('image_block_image');
$image_block_title = get_sub_field('image_block_title');
$image_block_button = get_sub_field('image_block_button');
$image_block_max_height = get_sub_field('image_block_max_height');
$images_block_2_images = get_sub_field('2_images_col');
$image_block_image_1 = get_sub_field('image_block_image_1');
$image_block_image_2 = get_sub_field('image_block_image_2');

require 'global-settings.php';
?>
<section class="image_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?> fade-in-on-scroll">
        <div class="row">
            <div class="col-12 col-lg-12">
                <?php if ($image_block_title): ?>
                    <div class="image_block__title-container">
                        <h2><?= $image_block_title ?></h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <?php if ($images_block_2_images): ?>
                <div class="col-12 col-lg-6">
                    <?php if ($image_block_image_1): ?>
                        <div class="image_block__image-container">
                            <img style="height: <?= $image_block_max_height ?>px;" src="<?= $image_block_image_1['url'] ?>"
                                alt="<?= $image_block_image_1['alt'] ?>" loading="<?= $lazy_load_class; ?>">
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-12 col-lg-6">
                    <?php if ($image_block_image_2): ?>
                        <div class="image_block__image-container">
                            <img style="height: <?= $image_block_max_height ?>px;" src="<?= $image_block_image_2['url'] ?>"
                                alt="<?= $image_block_image_2['alt'] ?>" loading="<?= $lazy_load_class; ?>">
                        </div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="col-12">
                    <?php if ($image_block_image): ?>
                        <div class="image_block__image-container">
                            <img style="height: <?= $image_block_max_height ?>px;" src="<?= $image_block_image['url'] ?>"
                                alt="<?= $image_block_image['alt'] ?>" loading="<?= $lazy_load_class; ?>">
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ($image_block_button): ?>
                    <div class="image_block__button-container">
                        <a href="<?= $image_block_button['url'] ?>" target="<?= $image_block_button['target'] ?>"
                            class="btn"><?= $image_block_button['title'] ?></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>