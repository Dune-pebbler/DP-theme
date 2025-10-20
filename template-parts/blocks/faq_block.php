<?php
$faq_block_title = get_sub_field('faq_title');
$faq_block_repeater = get_sub_field('faq_repeater');
require 'global-settings.php';
?>
<section class="faq_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?> fade-in-on-scroll">
        <div class="row">
            <div class="col-12">
                <?php if ($faq_block_title): ?>
                    <div class="faq_block__title-container">
                        <h2><?= $faq_block_title ?></h2>
                    </div>

                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <?php if ($faq_block_repeater): ?>
                    <?php foreach ($faq_block_repeater as $faq): ?>
                        <details class="faq_block__item">
                            <summary class="faq_block__question">
                                <?= $faq['faq_question'] ?>
                            </summary>

                            <div class="faq_block__answer">
                                <p><?= $faq['faq_answer'] ?></p>
                            </div>
                        </details>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>