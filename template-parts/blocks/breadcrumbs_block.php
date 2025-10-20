<?php
require 'global-settings.php';
?>
<section class="breadcrumbs-block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <div class="col-12">
                <?php get_template_part('template-parts/breadcrumbs'); ?>
            </div>
        </div>
    </div>
</section>