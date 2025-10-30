<?php
$hero_video_url = get_sub_field('hero_video_url');
$hero_video_poster = get_sub_field('hero_video_poster');
$hero_video_autoplay = get_sub_field('hero_video_autoplay');
$hero_video_description = get_sub_field('hero_video_description');
$hero_video_button = get_sub_field('hero_video_button');
$hero_video_text_position = get_sub_field('hero_video_text_position');
$hero_video_text_color = get_sub_field('hero_video_text_color');
$hero_video_overlay_color = get_sub_field('hero_video_overlay_color');
$hero_video_overlay_opacity = get_sub_field('hero_video_overlay_opacity');

@require 'global-settings.php';
function get_video_embed_url($url)
{
    if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        if (strpos($url, 'youtu.be') !== false) {
            $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
        } else {
            parse_str(parse_url($url, PHP_URL_QUERY), $query);
            $video_id = isset($query['v']) ? $query['v'] : '';
        }
        return 'https://www.youtube.com/embed/' . $video_id;
    } elseif (strpos($url, 'vimeo.com') !== false || strpos($url, 'player.vimeo.com') !== false) {
        if (strpos($url, 'player.vimeo.com') !== false) {
            return $url;
        } else {
            $video_id = substr(parse_url($url, PHP_URL_PATH), 1);
            return 'https://player.vimeo.com/video/' . $video_id;
        }
    }
    return $url;
}
?>
<section class="hero_video_block <?= $theme_class; ?> <?= $padding_class; ?>">
    <div class="<?= $container_class; ?>">
        <div class="row">
            <div class="col-12 p-0">
                <div class="hero_video_block__container">
                    <?php if ($hero_video_url): ?>
                        <div class="hero_video_block__video-container">
                            <?php if (strpos($hero_video_url, 'youtube.com') !== false || strpos($hero_video_url, 'youtu.be') !== false || strpos($hero_video_url, 'vimeo.com') !== false): ?>
                                <iframe
                                    src="<?= get_video_embed_url($hero_video_url); ?>?autoplay=<?= $hero_video_autoplay ? '1' : '0'; ?>&muted=<?= $hero_video_autoplay ? '1' : '0'; ?>&loop=1&controls=0&showinfo=0&rel=0&modestbranding=1&playsinline=1"
                                    frameborder="0" allow="autoplay; encrypted-media" allowfullscreen
                                    loading="<?= $lazy_load_class; ?>">
                                </iframe>
                            <?php else: ?>
                                <video <?= $hero_video_autoplay ? 'autoplay' : ''; ?> muted loop playsinline
                                    <?= $hero_video_poster ? 'poster="' . $hero_video_poster['url'] . '"' : ''; ?>>
                                    <source src="<?= $hero_video_url; ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($hero_video_overlay_color || $hero_video_overlay_opacity): ?>
                        <div class="hero_video_block__overlay"
                            style="<?= $hero_video_overlay_color ? 'background-color: ' . $hero_video_overlay_color . ';' : ''; ?> 
                                    <?= $hero_video_overlay_opacity ? 'opacity: ' . $hero_video_overlay_opacity . ';' : ''; ?>">
                        </div>
                    <?php endif; ?>

                    <div
                        class="hero_video_block__content hero_video_block__content--<?= $hero_video_text_position ?: 'center'; ?>">
                        <div class="hero_video_block__text-container"
                            style="<?= $hero_video_text_color ? 'color: ' . $hero_video_text_color . ';' : ''; ?>">
                            <?php if ($hero_video_description): ?>
                                <div class="hero_video_block__description">
                                    <?= $hero_video_description; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($hero_video_button): ?>
                                <div class="hero_video_block__button">
                                    <a href="<?= $hero_video_button['url']; ?>" class="btn-hero"
                                        <?= $hero_video_button['target'] ? 'target="' . $hero_video_button['target'] . '"' : ''; ?>>
                                        <?= $hero_video_button['title']; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>