<?php
function vienna_gaels_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'vienna-gaels'),
        'footer' => __('Footer Menu', 'vienna-gaels')
    ));
}
add_action('after_setup_theme', 'vienna_gaels_setup');

function vienna_gaels_scripts() {
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Noto+Sans:wght@100..900&display=swap', array(), null);
    wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap', array(), null);
    
    // Theme styles
    wp_enqueue_style('vienna-gaels-style', get_stylesheet_uri(), array(), '1.0');
    wp_enqueue_style('vienna-gaels-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), '1.0');
    
    // Scripts
    wp_enqueue_script('vienna-gaels-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'vienna_gaels_scripts');

// Add Tailwind in head with config INLINE
function vienna_gaels_tailwind_head() {
    ?>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#008040",
                        "background-light": "#fcfcfc",
                        "background-dark": "#1a1a1a",
                        "vienna-gold": "#DDBB5C",
                    },
                    fontFamily: {
                        "display": ["Lexend", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <?php
}
add_action('wp_head', 'vienna_gaels_tailwind_head', 1);

function vienna_gaels_custom_post_types() {
    // Events
    register_post_type('events', array(
        'labels' => array(
            'name' => __('Events', 'vienna-gaels'),
            'singular_name' => __('Event', 'vienna-gaels')
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon' => 'dashicons-calendar-alt',
        'rewrite' => array('slug' => 'events')
    ));
}
add_action('init', 'vienna_gaels_custom_post_types');

function vienna_gaels_event_meta_boxes() {
    add_meta_box(
        'event_details',
        'Event Details',
        'vienna_gaels_event_details_callback',
        'events',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vienna_gaels_event_meta_boxes');

function vienna_gaels_event_details_callback($post) {
    wp_nonce_field('vienna_gaels_event_details', 'vienna_gaels_event_nonce');
    $start_date = get_post_meta($post->ID, '_event_start_date', true);
    $end_date = get_post_meta($post->ID, '_event_end_date', true);
    $start_time = get_post_meta($post->ID, '_event_start_time', true);
    $end_time = get_post_meta($post->ID, '_event_end_time', true);
    $location = get_post_meta($post->ID, '_event_location', true);
    $type = get_post_meta($post->ID, '_event_type', true);
    $spond_url = get_post_meta($post->ID, '_spond_event_url', true);
    
    echo '<p><label><strong>Start Date:</strong> <input type="date" name="event_start_date" value="' . esc_attr($start_date) . '" required /></label></p>';
    echo '<p><label><strong>End Date (optional):</strong> <input type="date" name="event_end_date" value="' . esc_attr($end_date) . '" /></label></p>';
    echo '<p class="description" style="margin-top:-10px;margin-bottom:15px;">Leave empty for single-day events</p>';
    
    echo '<p><label><strong>Start Time:</strong> <input type="time" name="event_start_time" value="' . esc_attr($start_time) . '" required /></label></p>';
    echo '<p><label><strong>End Time (optional):</strong> <input type="time" name="event_end_time" value="' . esc_attr($end_time) . '" /></label></p>';
    echo '<p class="description" style="margin-top:-10px;margin-bottom:15px;">Leave empty if end time is not applicable</p>';
    
    echo '<p><label><strong>Location:</strong> <input type="text" name="event_location" value="' . esc_attr($location) . '" style="width:100%;" /></label></p>';
    
    echo '<p><label><strong>Type:</strong> <select name="event_type">';
    echo '<option value="training"' . selected($type, 'training', false) . '>Training</option>';
    echo '<option value="match"' . selected($type, 'match', false) . '>Match Day</option>';
    echo '<option value="social"' . selected($type, 'social', false) . '>Social</option>';
    echo '</select></label></p>';
    
    echo '<p><label><strong>Spond Event URL (optional):</strong> <input type="url" name="spond_event_url" value="' . esc_attr($spond_url) . '" style="width:100%;" placeholder="https://spond.com/..." /></label></p>';
    echo '<p class="description">If this event has a specific Spond page, paste the link here. Leave empty to show general Spond link.</p>';
}

function vienna_gaels_save_event_details($post_id) {
    if (!isset($_POST['vienna_gaels_event_nonce']) || !wp_verify_nonce($_POST['vienna_gaels_event_nonce'], 'vienna_gaels_event_details')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['event_start_date'])) {
        update_post_meta($post_id, '_event_start_date', sanitize_text_field($_POST['event_start_date']));
    }
    if (isset($_POST['event_end_date'])) {
        update_post_meta($post_id, '_event_end_date', sanitize_text_field($_POST['event_end_date']));
    }
    if (isset($_POST['event_start_time'])) {
        update_post_meta($post_id, '_event_start_time', sanitize_text_field($_POST['event_start_time']));
    }
    if (isset($_POST['event_end_time'])) {
        update_post_meta($post_id, '_event_end_time', sanitize_text_field($_POST['event_end_time']));
    }
    if (isset($_POST['event_location'])) {
        update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
    }
    if (isset($_POST['event_type'])) {
        update_post_meta($post_id, '_event_type', sanitize_text_field($_POST['event_type']));
    }
    if (isset($_POST['spond_event_url'])) {
        update_post_meta($post_id, '_spond_event_url', esc_url_raw($_POST['spond_event_url']));
    }
}
add_action('save_post_events', 'vienna_gaels_save_event_details');

// Enqueue AJAX script
function vienna_gaels_localize_script() {
    wp_localize_script('vienna-gaels-scripts', 'viennaGaelsAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('vienna_gaels_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'vienna_gaels_localize_script');

// Handle Contact Form Submission
function vienna_gaels_handle_contact_form() {
    check_ajax_referer('vienna_gaels_nonce', 'nonce');
    
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $interest = sanitize_text_field($_POST['interest']);
    $message = sanitize_textarea_field($_POST['message']);
    
    $to = get_option('admin_email');
    $subject = 'New Contact Form Submission - Vienna Gaels';
    $body = "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Phone: $phone\n";
    $body .= "Interest: $interest\n\n";
    $body .= "Message:\n$message";
    
    $headers = array('Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email);
    
    if (wp_mail($to, $subject, $body, $headers)) {
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}
add_action('wp_ajax_vienna_gaels_contact', 'vienna_gaels_handle_contact_form');
add_action('wp_ajax_nopriv_vienna_gaels_contact', 'vienna_gaels_handle_contact_form');

// Add Theme Customizer Options
function vienna_gaels_customize_register($wp_customize) {
    // Hero Section
    $wp_customize->add_section('hero_section', array(
        'title' => __('Homepage Hero', 'vienna-gaels'),
        'priority' => 30,
    ));
    
    $wp_customize->add_setting('hero_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'hero_image', array(
        'label' => __('Hero Image', 'vienna-gaels'),
        'section' => 'hero_section',
        'settings' => 'hero_image',
    )));
    
    // Hero Headline
    $wp_customize->add_setting('hero_headline', array(
        'default' => 'Experience the Heart of Ireland in Vienna.',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_headline', array(
        'label' => __('Hero Headline', 'vienna-gaels'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    // Hero Description
    $wp_customize->add_setting('hero_description', array(
        'default' => "Join Austria's premier Gaelic Games club. Whether you're a seasoned player or a complete beginner, there's a place for you in our community.",
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    $wp_customize->add_control('hero_description', array(
        'label' => __('Hero Description', 'vienna-gaels'),
        'section' => 'hero_section',
        'type' => 'textarea',
    ));
    
    // Primary Button Text
    $wp_customize->add_setting('hero_button_primary_text', array(
        'default' => 'Start Your Journey',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_button_primary_text', array(
        'label' => __('Primary Button Text', 'vienna-gaels'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    // Primary Button URL
    $wp_customize->add_setting('hero_button_primary_url', array(
        'default' => '/membership',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_button_primary_url', array(
        'label' => __('Primary Button URL', 'vienna-gaels'),
        'section' => 'hero_section',
        'type' => 'url',
        'description' => 'Use relative URLs like /membership or full URLs like https://example.com',
    ));
    
    // Secondary Button Text
    $wp_customize->add_setting('hero_button_secondary_text', array(
        'default' => 'View Teams',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('hero_button_secondary_text', array(
        'label' => __('Secondary Button Text', 'vienna-gaels'),
        'section' => 'hero_section',
        'type' => 'text',
    ));
    
    // Secondary Button URL
    $wp_customize->add_setting('hero_button_secondary_url', array(
        'default' => '#teams',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('hero_button_secondary_url', array(
        'label' => __('Secondary Button URL', 'vienna-gaels'),
        'section' => 'hero_section',
        'type' => 'url',
        'description' => 'Use #teams to scroll to teams section, or any URL',
    ));
    
    // Header CTA Button
    $wp_customize->add_section('header_cta', array(
        'title' => __('Header CTA Button', 'vienna-gaels'),
        'priority' => 31,
        'description' => 'Configure the call-to-action button in the header (visible on large screens)',
    ));
    
    // Show/Hide Header Button
    $wp_customize->add_setting('header_button_show', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('header_button_show', array(
        'label' => __('Show Header Button', 'vienna-gaels'),
        'section' => 'header_cta',
        'type' => 'checkbox',
        'description' => 'Check to display the button in the header',
    ));
    
    // Header Button Text
    $wp_customize->add_setting('header_button_text', array(
        'default' => 'Join Us',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('header_button_text', array(
        'label' => __('Button Text', 'vienna-gaels'),
        'section' => 'header_cta',
        'type' => 'text',
    ));
    
    // Header Button URL
    $wp_customize->add_setting('header_button_url', array(
        'default' => '/membership',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('header_button_url', array(
        'label' => __('Button URL', 'vienna-gaels'),
        'section' => 'header_cta',
        'type' => 'url',
        'description' => 'Where the button links to',
    ));
    
    // Social Media Links
    $wp_customize->add_section('social_links', array(
        'title' => __('Social Media Links', 'vienna-gaels'),
        'priority' => 35,
    ));
    
    $socials = array('facebook', 'twitter', 'instagram', 'youtube');
    foreach ($socials as $social) {
        $wp_customize->add_setting($social . '_link');
        $wp_customize->add_control($social . '_link', array(
            'label' => ucfirst($social) . ' URL',
            'section' => 'social_links',
            'type' => 'url',
        ));
    }
}
add_action('customize_register', 'vienna_gaels_customize_register');

// Add excerpt length control
function vienna_gaels_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'vienna_gaels_excerpt_length');

// Custom excerpt more text
function vienna_gaels_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'vienna_gaels_excerpt_more');

// Helper function to format event date/time display
function vienna_gaels_format_event_datetime($event_id) {
    $start_date = get_post_meta($event_id, '_event_start_date', true);
    $end_date = get_post_meta($event_id, '_event_end_date', true);
    $start_time = get_post_meta($event_id, '_event_start_time', true);
    $end_time = get_post_meta($event_id, '_event_end_time', true);
    
    // Format date
    if ($end_date && $end_date !== $start_date) {
        $date_str = date('l, M j', strtotime($start_date)) . ' - ' . date('M j', strtotime($end_date));
    } else {
        $date_str = date('l', strtotime($start_date));
    }
    
    // Format time
    if ($end_time) {
        $time_str = date('H:i', strtotime($start_time)) . ' - ' . date('H:i', strtotime($end_time));
    } else {
        $time_str = date('H:i', strtotime($start_time));
    }
    
    return array(
        'date' => $date_str,
        'time' => $time_str,
        'short_date' => date('M d', strtotime($start_date))
    );
}