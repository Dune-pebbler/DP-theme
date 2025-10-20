<?php
// content
$gallery_images = get_sub_field('masonry_gallery_gallery');
require 'global-settings.php';
$delay = 0
    ?>
<section class="block-masonry <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class ?> fade-in-on-scroll">
        <div class="row">
            <div class="col-12">
                <?php if ($gallery_images): ?>
                    <div class="masonry-grid">
                        <?php foreach ($gallery_images as $image): ?>
                            <div class="masonry-item" data-animate="zoom-in" data-animate-delay="<?= $delay ?>">
                                <a href="<?= esc_url($image['url']) ?>" data-fancybox="gallery">
                                    <img src="<?= esc_url($image['url']) ?>" alt="<?= esc_attr($image['alt']) ?>"
                                        loading="<?= $lazy_load_class; ?>">
                                </a>
                            </div>
                            <?php $delay += 50 ?>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>