<?php
$recent_posts_title = get_sub_field('recent_posts_title');
$recent_posts_post_type = get_sub_field('recent_posts_post_type') ?: 'post';
$recent_posts_count = get_sub_field('recent_posts_count') ?: 3;
$recent_posts_show_excerpt = get_sub_field('recent_posts_show_excerpt');
$recent_posts_excerpt_length = get_sub_field('recent_posts_excerpt_length') ?: 20;
require 'global-settings.php';

$args = array(
    'post_type' => $recent_posts_post_type,
    'posts_per_page' => $recent_posts_count,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC'
);

$recent_posts = new WP_Query($args);
?>

<section class="recent_posts_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?> fade-in-on-scroll">
        <?php if ($recent_posts_title): ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="recent_posts_block__title text-center"><?= $recent_posts_title; ?></h2>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="recent_posts_block__posts-grid">
                    <?php if ($recent_posts->have_posts()): ?>
                        <?php while ($recent_posts->have_posts()):
                            $recent_posts->the_post(); ?>
                            <div class="recent_posts_block__post-card" data-post-id="<?= get_the_ID(); ?>">
                                <div class="recent_posts_block__card-image">
                                    <?php if (has_post_thumbnail()): ?>
                                        <a href="<?= get_permalink(); ?>">
                                            <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                                alt="<?= get_the_title(); ?>" loading="lazy">
                                        </a>
                                    <?php else: ?>
                                        <div class="recent_posts_block__placeholder-image">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="recent_posts_block__card-content">
                                    <h3 class="recent_posts_block__card-title">
                                        <a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a>
                                    </h3>
                                    <div class="recent_posts_block__card-meta">
                                        <span class="recent_posts_block__card-date">
                                            <i class="far fa-calendar"></i> <?= get_the_date(); ?>
                                        </span>
                                    </div>
                                    <?php if ($recent_posts_show_excerpt): ?>
                                        <div class="recent_posts_block__card-excerpt">
                                            <?= wp_trim_words(get_the_excerpt(), $recent_posts_excerpt_length, '...'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <a href="<?= get_permalink(); ?>" class="recent_posts_block__card-link">
                                        Lees meer <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <div class="recent_posts_block__no-posts">
                            <p>Geen berichten gevonden.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>
