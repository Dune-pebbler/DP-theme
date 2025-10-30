<?php
$google_maps_location = get_sub_field('google_maps_location');
$google_maps_content = get_sub_field('google_maps_content');
$google_maps_two_columns = get_sub_field('google_maps_two_columns');
$google_maps_height = get_sub_field('google_maps_height') ?: 400;

@require 'global-settings.php';
?>

<section class="google_maps_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <?php if ($google_maps_location): ?>
                <?php if ($google_maps_two_columns && $google_maps_content): ?>
                    <div class="col-12 col-lg-6">
                        <div class="google_maps_block__content">
                            <?= $google_maps_content; ?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="google_maps_block__map-container">
                            <div class="google_maps_block__map" id="google-map-<?= get_row_index(); ?>"
                                data-lat="<?= $google_maps_location['lat']; ?>" data-lng="<?= $google_maps_location['lng']; ?>"
                                data-address="<?= esc_attr($google_maps_location['address']); ?>"
                                style="height: <?= $google_maps_height; ?>px;">
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-12">
                        <div class="google_maps_block__map-container">
                            <div class="google_maps_block__map" id="google-map-<?= get_row_index(); ?>"
                                data-lat="<?= $google_maps_location['lat']; ?>" data-lng="<?= $google_maps_location['lng']; ?>"
                                data-address="<?= esc_attr($google_maps_location['address']); ?>"
                                style="height: <?= $google_maps_height; ?>px;">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>