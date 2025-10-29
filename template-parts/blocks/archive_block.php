<?php
$archive_title = get_sub_field('archive_title');
$archive_post_type = get_sub_field('archive_post_type');
$archive_posts_per_page = get_sub_field('archive_posts_per_page') ?: 3;
$archive_search_placeholder = get_sub_field('archive_search_placeholder') ?: 'Search...';
$archive_show_search = get_sub_field('archive_show_search');
$archive_show_load_more = get_sub_field('archive_show_load_more');
require 'global-settings.php';

// Get initial posts
$args = array(
    'post_type' => $archive_post_type,
    'posts_per_page' => $archive_posts_per_page,
    'post_status' => 'publish',
    'paged' => 1
);

$archive_posts = new WP_Query($args);
$total_posts = $archive_posts->found_posts;
?>

<section class="archive_block <?= $theme_class; ?> <?= $padding_class; ?>" data-post-type="<?= $archive_post_type; ?>"
    data-posts-per-page="<?= $archive_posts_per_page; ?>">
    <div class="<?= $container_class; ?> fade-in-on-scroll">
        <?php if ($archive_title): ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="archive_block__title text-center"><?= $archive_title; ?></h2>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($archive_show_search): ?>
            <div class="row">
                <div class="col-12">
                    <div class="archive_block__search-container">
                        <div class="archive_block__search-wrapper">
                            <input type="text" class="archive_block__search-input"
                                placeholder="<?= $archive_search_placeholder; ?>" data-search-input>
                            <button class="archive_block__search-button" data-search-button>
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col-12">
                <div class="archive_block__results-container">
                    <div class="archive_block__loading" data-loading style="display: none;">
                        <div class="archive_block__spinner"></div>
                        <p>Laden...</p>
                    </div>

                    <div class="archive_block__posts-grid" data-posts-grid>
                        <?php if ($archive_posts->have_posts()): ?>
                            <?php while ($archive_posts->have_posts()):
                                $archive_posts->the_post(); ?>
                                <div class="archive_block__post-card" data-post-id="<?= get_the_ID(); ?>">
                                    <div class="archive_block__card-image">
                                        <?php if (has_post_thumbnail()): ?>
                                            <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                                alt="<?= get_the_title(); ?>" loading="lazy">
                                        <?php else: ?>
                                            <div class="archive_block__placeholder-image">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="archive_block__card-content">
                                        <h3 class="archive_block__card-title">
                                            <a href="<?= get_permalink(); ?>"><?= get_the_title(); ?></a>
                                        </h3>
                                        <div class="archive_block__card-meta">
                                            <span class="archive_block__card-date"><?= get_the_date(); ?></span>
                                            <?php if ($archive_post_type === 'post'): ?>
                                                <!-- <span class="archive_block__card-category">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ($categories) {
                                                        echo $categories[0]->name;
                                                    }
                                                    ?>
                                                </span> -->
                                            <?php endif; ?>
                                        </div>
                                        <div class="archive_block__card-excerpt">
                                            <?= wp_trim_words(get_the_excerpt(), 20, '...'); ?>
                                        </div>
                                        <a href="<?= get_permalink(); ?>" class="archive_block__card-link">
                                            Lees meer <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="archive_block__no-posts">
                                <p>No posts found.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($archive_show_load_more && $archive_posts->max_num_pages > 1): ?>
                        <div class="archive_block__load-more-container">
                            <button class="archive_block__load-more-btn" data-load-more>
                                Load More Posts
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php wp_reset_postdata(); ?>