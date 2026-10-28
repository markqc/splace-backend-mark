<?php
/**
 * Theme setup and Jobs registration.
 */
if (!defined('ABSPATH')) {
    exit;
}

/** Add Jobs to the dashboard and make published jobs available on the website. */
function splace_backend_register_jobs() {
    register_post_type('splace_job', [
        'labels' => [
            'name'               => __('Jobs', 'splace-backend-assessment'),
            'singular_name'      => __('Job', 'splace-backend-assessment'),
            'menu_name'          => __('Jobs', 'splace-backend-assessment'),
            'all_items'          => __('All Jobs', 'splace-backend-assessment'),
            'add_new'            => __('Add New Job', 'splace-backend-assessment'),
            'add_new_item'       => __('Add New Job', 'splace-backend-assessment'),
            'edit_item'          => __('Edit Job', 'splace-backend-assessment'),
            'new_item'           => __('New Job', 'splace-backend-assessment'),
            'view_item'          => __('View Job', 'splace-backend-assessment'),
            'search_items'       => __('Search Jobs', 'splace-backend-assessment'),
            'not_found'          => __('No jobs found.', 'splace-backend-assessment'),
            'not_found_in_trash' => __('No jobs found in Trash.', 'splace-backend-assessment'),
        ],
        'public'       => true,
        'show_in_rest' => true,
        'has_archive'  => 'jobs',
        'rewrite'      => ['slug' => 'jobs'],
        'menu_icon'    => 'dashicons-businessperson',
        'supports'     => ['title', 'editor', 'revisions'],
    ]);
}
add_action('init', 'splace_backend_register_jobs');

/** Label the existing WordPress title box as Job Title. */
function splace_backend_job_title_placeholder($placeholder, $post) {
    if ($post->post_type === 'splace_job') {
        return __('Job Title', 'splace-backend-assessment');
    }
    return $placeholder;
}
add_filter('enter_title_here', 'splace_backend_job_title_placeholder', 10, 2);

/** Prepare job page addresses when this theme is activated. */
function splace_backend_activate() {
    splace_backend_register_jobs();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'splace_backend_activate');

/** Register the extra information stored with each job. */
function splace_backend_job_fields() {
    foreach (['salary', 'location'] as $field) {
        register_post_meta('splace_job', '_splace_backend_' . $field, [
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'sanitize_text_field',
            'auth_callback'     => static function ($allowed, $meta_key, $post_id) {
                return current_user_can('edit_post', $post_id);
            },
        ]);
    }
}
add_action('init', 'splace_backend_job_fields');

/** Add a Job Details box to the job editor. */
function splace_backend_add_job_details_box() {
    add_meta_box(
        'splace-backend-job-details',
        __('Job Details', 'splace-backend-assessment'),
        'splace_backend_render_job_details',
        'splace_job',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'splace_backend_add_job_details_box');

/** Show the saved Salary and Location values in editable boxes. */
function splace_backend_render_job_details($post) {
    wp_nonce_field('splace_backend_save_job_details', 'splace_backend_job_nonce');
    $fields = [
        'salary'   => __('Salary', 'splace-backend-assessment'),
        'location' => __('Location', 'splace-backend-assessment'),
    ];
    foreach ($fields as $key => $label) {
        $value = get_post_meta($post->ID, '_splace_backend_' . $key, true);
        ?>
        <p>
            <label for="splace-backend-<?php echo esc_attr($key); ?>">
                <strong><?php echo esc_html($label); ?></strong>
            </label>
            <input class="widefat" type="text"
                id="splace-backend-<?php echo esc_attr($key); ?>"
                name="splace_backend_<?php echo esc_attr($key); ?>"
                value="<?php echo esc_attr($value); ?>">
        </p>
        <?php
    }
}

/** Save changes only when submitted by someone allowed to edit the job. */
function splace_backend_save_job_details($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (wp_is_post_revision($post_id) || !current_user_can('edit_post', $post_id)) {
        return;
    }
    if (
        !isset($_POST['splace_backend_job_nonce']) ||
        !is_string($_POST['splace_backend_job_nonce']) ||
        !wp_verify_nonce(
            sanitize_text_field(wp_unslash($_POST['splace_backend_job_nonce'])),
            'splace_backend_save_job_details'
        )
    ) {
        return;
    }
    foreach (['salary', 'location'] as $field) {
        $input = 'splace_backend_' . $field;
        // Quick Edit and other requests without these boxes must retain saved values.
        if (!isset($_POST[$input]) || !is_string($_POST[$input])) {
            continue;
        }
        $value = sanitize_text_field(wp_unslash($_POST[$input]));
        $meta_key = '_splace_backend_' . $field;
        if ($value === '') {
            delete_post_meta($post_id, $meta_key);
        } else {
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('save_post_splace_job', 'splace_backend_save_job_details');

/** Load the basic appearance and let WordPress set each page title. */
function splace_backend_theme_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'splace_backend_theme_setup');

function splace_backend_styles() {
    wp_enqueue_style('splace-backend', get_stylesheet_uri(), [], '1.1');
}
add_action('wp_enqueue_scripts', 'splace_backend_styles');

/** Keep the salary and location display consistent on both job pages. */
function splace_backend_display_job_details() {
    echo '<dl class="job-details">';
    foreach (['salary' => __('Salary', 'splace-backend-assessment'), 'location' => __('Location', 'splace-backend-assessment')] as $field => $label) {
        $value = get_post_meta(get_the_ID(), '_splace_backend_' . $field, true);
        echo '<dt>' . esc_html($label) . '</dt>';
        echo '<dd>' . esc_html($value !== '' ? $value : __('Not specified', 'splace-backend-assessment')) . '</dd>';
    }
    echo '</dl>';
}
