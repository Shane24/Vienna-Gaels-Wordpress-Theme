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
    wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap', array(), null);
    
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
    
    // Event Types taxonomy
    register_taxonomy('event_type', 'events', array(
        'labels' => array(
            'name' => __('Event Types', 'vienna-gaels'),
            'singular_name' => __('Event Type', 'vienna-gaels'),
            'add_new_item' => __('Add New Event Type', 'vienna-gaels'),
            'edit_item' => __('Edit Event Type', 'vienna-gaels'),
            'search_items' => __('Search Event Types', 'vienna-gaels'),
        ),
        'hierarchical' => false,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'event-type')
    ));
}
add_action('init', 'vienna_gaels_custom_post_types');

// Add default event types on theme activation
function vienna_gaels_add_default_event_types() {
    $default_types = array('Training', 'Tournament', 'Social');
    
    foreach ($default_types as $type) {
        if (!term_exists($type, 'event_type')) {
            wp_insert_term($type, 'event_type');
        }
    }
}
add_action('after_switch_theme', 'vienna_gaels_add_default_event_types');

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
    $spond_url = get_post_meta($post->ID, '_spond_event_url', true);
    
    echo '<p><label><strong>Start Date:</strong> <input type="date" name="event_start_date" value="' . esc_attr($start_date) . '" required /></label></p>';
    echo '<p><label><strong>End Date (optional):</strong> <input type="date" name="event_end_date" value="' . esc_attr($end_date) . '" /></label></p>';
    echo '<p class="description" style="margin-top:-10px;margin-bottom:15px;">Leave empty for single-day events</p>';
    
    echo '<p><label><strong>Start Time:</strong> <input type="time" name="event_start_time" value="' . esc_attr($start_time) . '" required /></label></p>';
    echo '<p><label><strong>End Time (optional):</strong> <input type="time" name="event_end_time" value="' . esc_attr($end_time) . '" /></label></p>';
    echo '<p class="description" style="margin-top:-10px;margin-bottom:15px;">Leave empty if end time is not applicable</p>';
    
    echo '<p><label><strong>Location:</strong> <input type="text" name="event_location" value="' . esc_attr($location) . '" style="width:100%;" /></label></p>';
    
    echo '<p><strong>Event Type:</strong><br>';
    echo 'Select from the "Event Types" box on the right sidebar, or <a href="' . admin_url('edit-tags.php?taxonomy=event_type&post_type=events') . '" target="_blank">manage event types here</a>.</p>';
    
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

// Add Website Help page to admin menu
function vienna_gaels_admin_help_menu() {
    add_menu_page(
        'Website Help',
        'Website Help',
        'edit_posts',
        'vienna-gaels-help',
        'vienna_gaels_help_page_content',
        'dashicons-sos',
        90
    );
}
add_action('admin_menu', 'vienna_gaels_admin_help_menu');

function vienna_gaels_help_page_content() {
    ?>
    <div class="wrap">
        <h1>🏉 Vienna Gaels Website - Quick Help</h1>
        
        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Welcome to the Vienna Gaels Website Admin!</h2>
            <p>This quick guide will help you with the most common tasks. For detailed instructions, see the full documentation.</p>
            
            <p style="background: #e7f5ff; padding: 15px; border-left: 4px solid #008040; margin: 20px 0;">
                <strong>📖 Full Documentation:</strong><br>
                <a href="https://github.com/Shane24/Vienna-Gaels-Wordpress-Theme/blob/main/DOCUMENTATION.md" target="_blank" style="font-size: 16px;">
                    View Complete User Guide on GitHub →
                </a>
            </p>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Most Common Tasks</h2>
            
            <h3>➕ Add an Event</h3>
            <ol>
                <li>Click <strong>Events → Add New</strong></li>
                <li>Enter event title (e.g., "Football Training")</li>
                <li>Fill in Event Details:
                    <ul>
                        <li><strong>Start Date</strong> (required)</li>
                        <li><strong>Start Time</strong> (required)</li>
                        <li><strong>Location</strong> (e.g., "Prater, Vienna")</li>
                        <li><strong>Type</strong> (Training/Match/Social)</li>
                        <li>End date/time are optional</li>
                    </ul>
                </li>
                <li>Click <strong>Publish</strong></li>
            </ol>

            <h3>✏️ Edit Homepage Buttons</h3>
            <ol>
                <li>Go to <strong>Appearance → Customize</strong></li>
                <li>Click <strong>"Homepage Hero"</strong> to edit main buttons</li>
                <li>Or click <strong>"Header CTA Button"</strong> for top-right button</li>
                <li>Change text and links</li>
                <li>Click <strong>Publish</strong></li>
            </ol>

            <h3>📰 Publish News Article</h3>
            <ol>
                <li>Click <strong>Posts → Add New</strong></li>
                <li>Write your article</li>
                <li>Add <strong>Featured Image</strong> (right sidebar)</li>
                <li>Select <strong>Category</strong></li>
                <li>Click <strong>Publish</strong></li>
            </ol>

            <h3>🏉 Update Team Pages</h3>
            <ol>
                <li>Go to <strong>Pages → All Pages</strong></li>
                <li>Find team page (Men's Football, Hurling, etc.)</li>
                <li>Click <strong>Edit</strong></li>
                <li>Update content and images</li>
                <li>Click <strong>Update</strong></li>
            </ol>

            <h3>📋 Edit Navigation Menu</h3>
            <ol>
                <li>Go to <strong>Appearance → Menus</strong></li>
                <li>Add, remove, or rearrange items</li>
                <li>Drag items right to create dropdowns</li>
                <li>Click <strong>Save Menu</strong></li>
            </ol>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Quick Tips</h2>
            
            <p><strong>💡 Can't see your changes?</strong><br>
            Make sure you clicked <strong>Publish/Update</strong>, then hard refresh: <strong>Ctrl+Shift+R</strong> (Windows) or <strong>Cmd+Shift+R</strong> (Mac)</p>

            <p><strong>💡 Made a mistake?</strong><br>
            Items go to <strong>Trash</strong> first - you can restore them before permanent deletion.</p>

            <p><strong>💡 Need to give someone access?</strong><br>
            Go to <strong>Users → Add New</strong>. Use <strong>Editor</strong> role for committee members.</p>

            <p><strong>💡 Image size recommendations:</strong></p>
            <ul>
                <li>Homepage hero: 1200x1500px (portrait)</li>
                <li>Team photos: 800x1200px (portrait)</li>
                <li>News images: 1200x800px (landscape)</li>
                <li>Keep images under 500KB</li>
            </ul>
        </div>

        <div class="card" style="max-width: 800px; margin-top: 20px;">
            <h2>Need More Help?</h2>
            
            <p style="font-size: 16px;">
                <strong>📖 Complete Documentation:</strong><br>
                <a href="https://github.com/Shane24/Vienna-Gaels-Wordpress-Theme/blob/main/DOCUMENTATION.md" target="_blank">
                    https://github.com/Shane24/Vienna-Gaels-Wordpress-Theme/blob/main/DOCUMENTATION.md
                </a>
            </p>

            <p>The full documentation includes:</p>
            <ul>
                <li>Detailed step-by-step instructions</li>
                <li>Troubleshooting section</li>
                <li>Best practices</li>
                <li>Security tips</li>
                <li>Common problems and solutions</li>
            </ul>

            <p><strong>🆘 Something broken?</strong> Check the troubleshooting section in the full documentation or contact the web team.</p>
        </div>

        <div style="margin-top: 30px; padding: 15px; background: #f0f0f0; border-radius: 4px;">
            <p style="margin: 0;"><strong>Vienna Gaels GAA Theme</strong> | Version 1.0 | <a href="https://github.com/Shane24/Vienna-Gaels-Wordpress-Theme" target="_blank">View on GitHub</a></p>
        </div>
    </div>
    <?php
}

// Add admin notice with membership page instructions
function vienna_gaels_membership_help() {
    $screen = get_current_screen();
    
    if ($screen->id === 'page' && isset($_GET['post'])) {
        $post_id = $_GET['post'];
        $template = get_post_meta($post_id, '_wp_page_template', true);
        
        if ($template === 'page-membership.php') {
            ?>
            <div class="notice notice-info">
                <h3>💡 Membership Page Guide</h3>
                <p><strong>How to create membership cards:</strong></p>
                <ol>
                    <li>Add a <strong>Columns block</strong> (3 columns for desktop)</li>
                    <li>In each column, add the following structure using <strong>Custom HTML block</strong>:</li>
                </ol>
                <pre style="background: #f5f5f5; padding: 15px; overflow-x: auto; border-radius: 4px;">&lt;div class="membership-card featured"&gt;
    &lt;div class="icon"&gt;
        &lt;span class="material-symbols-outlined" style="font-size: 2rem; color: #008040;"&gt;sports&lt;/span&gt;
    &lt;/div&gt;
    &lt;h3&gt;Player&lt;/h3&gt;
    &lt;div class="membership-price"&gt;
        €100&lt;span class="period"&gt;/year&lt;/span&gt;
    &lt;/div&gt;
    &lt;ul&gt;
        &lt;li&gt;Full training access&lt;/li&gt;
        &lt;li&gt;Match day participation&lt;/li&gt;
        &lt;li&gt;Club jersey included&lt;/li&gt;
        &lt;li&gt;Social events access&lt;/li&gt;
    &lt;/ul&gt;
    &lt;a href="/contact" class="button"&gt;Sign Up as Player&lt;/a&gt;
&lt;/div&gt;</pre>
                <p><strong>Card variations:</strong></p>
                <ul>
                    <li>Remove <code>featured</code> class for regular cards</li>
                    <li>Add <code>gold</code> class for gold-tier styling: <code>class="membership-card gold"</code></li>
                </ul>
                <p><strong>Other components available:</strong> Benefits Grid, FAQ sections, Callout boxes. <a href="https://github.com/Shane24/Vienna-Gaels-Wordpress-Theme/blob/main/DOCUMENTATION.md" target="_blank">See full documentation</a></p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'vienna_gaels_membership_help');

// Add custom subtitle field for pages
function vienna_gaels_page_subtitle_meta_box() {
    add_meta_box(
        'page_subtitle',
        'Page Subtitle',
        'vienna_gaels_page_subtitle_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vienna_gaels_page_subtitle_meta_box');

function vienna_gaels_page_subtitle_callback($post) {
    wp_nonce_field('vienna_gaels_page_subtitle', 'vienna_gaels_page_subtitle_nonce');
    $subtitle = get_post_meta($post->ID, 'page_subtitle', true);
    ?>
    <p>
        <label for="page_subtitle" style="display: block; margin-bottom: 5px; font-weight: 600;">
            Enter a subtitle that will appear below the page title:
        </label>
        <input 
            type="text" 
            id="page_subtitle" 
            name="page_subtitle" 
            value="<?php echo esc_attr($subtitle); ?>" 
            style="width: 100%; padding: 8px; font-size: 16px;"
            placeholder="e.g., Become part of Austria's premier Gaelic Games community"
        >
    </p>
    <p class="description">This subtitle will appear on pages using special templates like the Membership page.</p>
    <?php
}

function vienna_gaels_save_page_subtitle($post_id) {
    if (!isset($_POST['vienna_gaels_page_subtitle_nonce']) || 
        !wp_verify_nonce($_POST['vienna_gaels_page_subtitle_nonce'], 'vienna_gaels_page_subtitle')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['page_subtitle'])) {
        update_post_meta($post_id, 'page_subtitle', sanitize_text_field($_POST['page_subtitle']));
    }
}
add_action('save_post_page', 'vienna_gaels_save_page_subtitle');

// ============================================
// SPONSORS CUSTOM POST TYPE
// ============================================

// Register Sponsors Custom Post Type
function vienna_gaels_sponsors_post_type() {
    register_post_type('sponsors', array(
        'labels' => array(
            'name' => __('Sponsors', 'vienna-gaels'),
            'singular_name' => __('Sponsor', 'vienna-gaels'),
            'add_new' => __('Add New Sponsor', 'vienna-gaels'),
            'add_new_item' => __('Add New Sponsor', 'vienna-gaels'),
            'edit_item' => __('Edit Sponsor', 'vienna-gaels'),
            'new_item' => __('New Sponsor', 'vienna-gaels'),
            'view_item' => __('View Sponsor', 'vienna-gaels'),
            'search_items' => __('Search Sponsors', 'vienna-gaels'),
            'not_found' => __('No sponsors found', 'vienna-gaels'),
            'all_items' => __('All Sponsors', 'vienna-gaels'),
        ),
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-awards',
        'supports' => array('title', 'thumbnail'),
        'rewrite' => false,
        'publicly_queryable' => false,
    ));
}
add_action('init', 'vienna_gaels_sponsors_post_type');

// Add Sponsor URL Meta Box
function vienna_gaels_sponsor_meta_boxes() {
    add_meta_box(
        'sponsor_url',
        'Sponsor Website URL',
        'vienna_gaels_sponsor_url_callback',
        'sponsors',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'vienna_gaels_sponsor_meta_boxes');

function vienna_gaels_sponsor_url_callback($post) {
    wp_nonce_field('vienna_gaels_sponsor_url', 'vienna_gaels_sponsor_url_nonce');
    $url = get_post_meta($post->ID, '_sponsor_url', true);
    $order = get_post_meta($post->ID, '_sponsor_order', true);
    ?>
    <p>
        <label for="sponsor_url" style="display: block; margin-bottom: 5px; font-weight: 600;">
            Sponsor Website URL (optional):
        </label>
        <input 
            type="url" 
            id="sponsor_url" 
            name="sponsor_url" 
            value="<?php echo esc_url($url); ?>" 
            style="width: 100%; padding: 8px; font-size: 16px;"
            placeholder="https://sponsor-website.com"
        >
        <span class="description">If provided, clicking the logo will open this website.</span>
    </p>
    
    <p style="margin-top: 20px;">
        <label for="sponsor_order" style="display: block; margin-bottom: 5px; font-weight: 600;">
            Display Order:
        </label>
        <input 
            type="number" 
            id="sponsor_order" 
            name="sponsor_order" 
            value="<?php echo esc_attr($order ? $order : 0); ?>" 
            style="width: 100px; padding: 8px; font-size: 16px;"
            min="0"
            step="1"
        >
        <span class="description">Lower numbers appear first (0, 1, 2, etc.)</span>
    </p>
    <?php
}

function vienna_gaels_save_sponsor_meta($post_id) {
    if (!isset($_POST['vienna_gaels_sponsor_url_nonce']) || 
        !wp_verify_nonce($_POST['vienna_gaels_sponsor_url_nonce'], 'vienna_gaels_sponsor_url')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    if (isset($_POST['sponsor_url'])) {
        update_post_meta($post_id, '_sponsor_url', esc_url_raw($_POST['sponsor_url']));
    }
    
    if (isset($_POST['sponsor_order'])) {
        update_post_meta($post_id, '_sponsor_order', intval($_POST['sponsor_order']));
    }
}
add_action('save_post_sponsors', 'vienna_gaels_save_sponsor_meta');

// Set featured image labels for sponsors
function vienna_gaels_sponsor_featured_image_labels($labels) {
    global $post_type;
    
    if ($post_type === 'sponsors') {
        $labels->featured_image = __('Sponsor Logo', 'vienna-gaels');
        $labels->set_featured_image = __('Set sponsor logo', 'vienna-gaels');
        $labels->remove_featured_image = __('Remove sponsor logo', 'vienna-gaels');
        $labels->use_featured_image = __('Use as sponsor logo', 'vienna-gaels');
    }
    
    return $labels;
}
add_filter('post_type_labels_sponsors', 'vienna_gaels_sponsor_featured_image_labels');