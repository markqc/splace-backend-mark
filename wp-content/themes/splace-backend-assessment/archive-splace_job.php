<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main id="main-content" class="container main-content">
    <h1><?php esc_html_e('Current Jobs', 'splace-backend-assessment'); ?></h1>
    <?php if (have_posts()) : ?>
        <div class="job-list">
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class('job-card'); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php splace_backend_display_job_details(); ?>
                <a href="<?php the_permalink(); ?>"><?php esc_html_e('View job', 'splace-backend-assessment'); ?><span class="screen-reader-text">: <?php the_title(); ?></span> &rarr;</a>
            </article>
        <?php endwhile; ?>
        </div>
        <?php the_posts_pagination(); ?>
    <?php else : ?>
        <p><?php esc_html_e('No jobs are currently available.', 'splace-backend-assessment'); ?></p>
    <?php endif; ?>
</main>
<?php get_footer(); ?>
