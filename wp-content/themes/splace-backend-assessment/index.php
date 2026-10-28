<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main id="main-content" class="container main-content">
    <?php if (is_home()) : ?>
        <h1><?php esc_html_e('Splace Backend Assessment', 'splace-backend-assessment'); ?></h1>
        <p><a href="<?php echo esc_url(get_post_type_archive_link('splace_job')); ?>"><?php esc_html_e('Browse current jobs', 'splace-backend-assessment'); ?> &rarr;</a></p>
    <?php elseif (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('job-card'); ?>>
                <?php if (is_singular()) : ?><h1><?php the_title(); ?></h1>
                <?php else : ?><h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><?php endif; ?>
                <div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
            </article>
        <?php endwhile; the_posts_pagination(); ?>
    <?php else : ?>
        <h1><?php esc_html_e('Page not found', 'splace-backend-assessment'); ?></h1>
        <p><a href="<?php echo esc_url(get_post_type_archive_link('splace_job')); ?>"><?php esc_html_e('Browse current jobs', 'splace-backend-assessment'); ?></a></p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
