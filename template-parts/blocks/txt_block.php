<?php
$txt_block_text = get_sub_field('txt_block_content');
$txt_block_button = get_sub_field('txt_block_button');
$txt_block_txt_position = get_sub_field('txt_block_txt_position');
$txt_block_text_1 = get_sub_field('txt_block_content_1');
$txt_block_button_1 = get_sub_field('txt_block_button_1');
$txt_block_text_2 = get_sub_field('txt_block_content_2');
$txt_block_button_2 = get_sub_field('txt_block_button_2');
$txt_block_col_switcher = get_sub_field('txt_block_col_switcher');
require 'global-settings.php';
?>
<section class="txt_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div
            class="row <?= $txt_block_col_switcher ? 'justify-content-evenly' : 'justify-content-center'; ?> fade-in-on-scroll">
            <?php if ($txt_block_col_switcher): ?>
                <div class="col-12 col-lg-5">
                    <div class="text-container <?= $txt_block_txt_position; ?>">
                        <?php if ($txt_block_text_1): ?>
                            <?= $txt_block_text_1; ?>
                            <?php if ($txt_block_button_1): ?>
                                <a href="<?= $txt_block_button_1['url']; ?>" target="<?= $txt_block_button_1['target']; ?>"
                                    class="btn"><?= $txt_block_button_1['title']; ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="text-container <?= $txt_block_txt_position; ?>">
                        <?php if ($txt_block_text_2): ?>
                            <?= $txt_block_text_2; ?>
                            <?php if ($txt_block_button_2): ?>
                                <a href="<?= $txt_block_button_2['url']; ?>" target="<?= $txt_block_button_2['target']; ?>"
                                    class="btn"><?= $txt_block_button_2['title']; ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="col-12 col-lg-10">
                    <div class="text-container <?= $txt_block_txt_position; ?>">
                        <?php if ($txt_block_text): ?>
                            <?= $txt_block_text; ?>
                            <?php if ($txt_block_button): ?>
                                <a href="<?= $txt_block_button['url']; ?>" target="<?= $txt_block_button['target']; ?>"
                                    class="btn"><?= $txt_block_button['title']; ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>