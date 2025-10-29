<div class="breadcrumbs">
    <a style="text-decoration:none: color:var(--text-color);" href="<?= home_url() ?>">Home </a> >
    <?php if (is_category() || is_single()): ?>
        <?php the_category('  >  '); ?>
        <?php if (is_single()): ?>
            > <?php the_title(); ?>
        <?php endif; ?>
    <?php elseif (is_page()): ?>
        <?php
        if ($post->post_parent):
            $anc = get_post_ancestors($post->ID);
            $anc = array_reverse($anc);
            foreach ($anc as $ancestor):
                ?>
                <a href="<?= get_permalink($ancestor) ?>"><?= get_the_title($ancestor) ?></a> »
                <?php
            endforeach;
        endif;
        ?>
        <?php the_title(); ?>
    <?php elseif (is_search()): ?>
        Search Results for "<?= get_search_query() ?>"
    <?php endif; ?>
</div>