<?php
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<main id="main-content" class="container main-content">
    <p><a href="<?php echo esc_url(get_post_type_archive_link('splace_job')); ?>">&larr; <?php esc_html_e('All jobs', 'splace-backend-assessment'); ?></a></p>
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class('job-card'); ?>>
            <h1><?php the_title(); ?></h1>
            <?php splace_backend_display_job_details(); ?>
            <div class="entry-content"><?php the_content(); wp_link_pages(); ?></div>
        </article>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
