<?php
$contact_content = get_sub_field('contact_content');
require 'global-settings.php';
?>
<section class="contact_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row justify-content-center fade-in-on-scroll">
            <div class="col-12 col-lg-10">
                <div class="contact-container">
                    <?php if ($contact_content): ?>
                        <?= do_shortcode($contact_content); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>