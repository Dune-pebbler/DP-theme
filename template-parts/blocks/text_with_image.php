<?php
// Retrieve current section fields
$txt_with_image_text = get_sub_field('img_txt_content');
$txt_with_image_image = get_sub_field('img_txt_image');
$txt_with_image_reverse = get_sub_field('img_txt_layout');
$txt_with_image_small_image = get_sub_field('img_txt_small-image');
$txt_with_image_button = get_sub_field('img_txt_button');

// Define column class based on image size setting
$image_col = $txt_with_image_small_image ? 'col-lg-4' : 'col-lg-6';

require 'global-settings.php';
?>

<section class="text_image <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?> fade-in-on-scroll">
        <div class="row justify-content-center <?= $txt_with_image_reverse ? 'flex-row-reverse' : ''; ?>">
            <div class="col-10 col-lg-5">
                <?php if ($txt_with_image_text): ?>
                    <div class="text_image__text-container">
                        <?= $txt_with_image_text; ?>
                        <?php if ($txt_with_image_button): ?>
                            <a href="<?= $txt_with_image_button['url']; ?>" target="<?= $txt_with_image_button['target']; ?>"
                                class="btn"><?= $txt_with_image_button['title']; ?></a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($txt_with_image_image): ?>
                <div class="col-lg-1"></div>
                <div class="col-10 <?= $image_col; ?>">
                    <div class="text_image__image-container">
                        <img src="<?= $txt_with_image_image['url']; ?>" alt="<?= $txt_with_image_image['alt']; ?>"
                            loading="<?= $lazy_load_class; ?>">
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>