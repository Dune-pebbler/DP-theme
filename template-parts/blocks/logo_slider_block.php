<?php
$logo_slider_items = get_sub_field('logo_slider_items');
$logo_slider_speed = get_sub_field('logo_slider_speed');

@require 'global-settings.php';
?>
<section class="logo_slider_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <div class="col-12">
                <?php if ($logo_slider_items && is_array($logo_slider_items)): ?>
                    <div class="logo_slider_block__slider owl-carousel"
                        data-speed="<?= $logo_slider_speed ? intval($logo_slider_speed) : 8000; ?>">
                        <?php foreach ($logo_slider_items as $item):
                            $image = isset($item['logo_image']) ? $item['logo_image'] : null;
                            $link = isset($item['logo_link']) ? $item['logo_link'] : null; ?>
                            <div class="logo_slider_block__item">
                                <?php if ($link && is_array($link) && !empty($link['url'])): ?>
                                    <a href="<?= esc_url($link['url']); ?>"
                                        target="<?= !empty($link['target']) ? esc_attr($link['target']) : '_self'; ?>"
                                        rel="noopener">
                                        <?php if ($image && !empty($image['url'])): ?>
                                            <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt'] ?? ''); ?>"
                                                loading="<?= $lazy_load_class; ?>" />
                                        <?php endif; ?>
                                    </a>
                                <?php else: ?>
                                    <?php if ($image && !empty($image['url'])): ?>
                                        <img src="<?= esc_url($image['url']); ?>" alt="<?= esc_attr($image['alt'] ?? ''); ?>"
                                            loading="<?= $lazy_load_class; ?>" />
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>