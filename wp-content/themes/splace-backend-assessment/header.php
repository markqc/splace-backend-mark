<?php if (!defined('ABSPATH')) { exit; } ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link" href="#main-content"><?php esc_html_e('Skip to content', 'splace-backend-assessment'); ?></a>
<header class="site-header">
    <div class="container header-inner">
        <a class="site-name" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <nav aria-label="<?php esc_attr_e('Main navigation', 'splace-backend-assessment'); ?>">
            <a href="<?php echo esc_url(get_post_type_archive_link('splace_job')); ?>"><?php esc_html_e('Jobs', 'splace-backend-assessment'); ?></a>
        </nav>
    </div>
</header>
