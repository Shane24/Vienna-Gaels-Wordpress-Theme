<!DOCTYPE html>
<html <?php language_attributes(); ?> class="light">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('bg-background-light dark:bg-background-dark text-[#0c1d14] dark:text-[#f8fcfa]'); ?>>
<?php wp_body_open(); ?>

<!-- Top Navigation -->
<header class="sticky top-0 z-50 w-full bg-background-light/90 dark:bg-background-dark/90 backdrop-blur-md border-b border-primary/10">
    <div class="max-w-[1400px] mx-auto px-6 h-20 flex items-center justify-between">
        <!-- Logo Section -->
        <div class="flex items-center gap-3 flex-shrink-0">
            <?php if (has_custom_logo()) : 
                $custom_logo_id = get_theme_mod('custom_logo');
                $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
            ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3">
                    <img src="<?php echo esc_url($logo_url); ?>" alt="<?php bloginfo('name'); ?>" class="h-14 w-auto object-contain">
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-black tracking-tight leading-none"><?php bloginfo('name'); ?></h1>
                        <p class="text-[9px] font-bold text-primary tracking-[0.15em] uppercase"><?php bloginfo('description'); ?></p>
                    </div>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3">
                    <div class="size-12 bg-primary rounded-lg flex items-center justify-center text-white flex-shrink-0">
                        <span class="material-symbols-outlined text-2xl">sports_rugby</span>
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-lg font-black tracking-tight leading-none"><?php bloginfo('name'); ?></h1>
                        <p class="text-[9px] font-bold text-primary tracking-[0.15em] uppercase"><?php bloginfo('description'); ?></p>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-8">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '%3$s',
                'depth' => 1,
                'walker' => new class extends Walker_Nav_Menu {
                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                        $classes = empty($item->classes) ? array() : (array) $item->classes;
                        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
                        
                        $output .= '<a href="' . esc_url($item->url) . '" class="text-sm font-semibold hover:text-primary transition-colors whitespace-nowrap">';
                        $output .= esc_html($item->title);
                        $output .= '</a>';
                    }
                }
            ));
            ?>
        </nav>

        <!-- CTA + Mobile Menu Button -->
        <div class="flex items-center gap-4">
            <a href="<?php echo esc_url(home_url('/membership')); ?>" class="hidden md:flex bg-primary text-white px-5 py-2.5 rounded-lg font-bold text-sm tracking-wide hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 whitespace-nowrap">
                Join Us
            </a>
            <button id="mobile-menu-toggle" class="lg:hidden text-primary p-2 hover:bg-primary/10 rounded-lg transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-primary/10 bg-white dark:bg-neutral-900">
        <nav class="max-w-[1400px] mx-auto px-6 py-6">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex flex-col gap-4',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<div class="%2$s">%3$s</div>',
                'depth' => 1,
                'walker' => new class extends Walker_Nav_Menu {
                    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                        $output .= '<a href="' . esc_url($item->url) . '" class="text-base font-semibold hover:text-primary transition-colors py-2 block">';
                        $output .= esc_html($item->title);
                        $output .= '</a>';
                    }
                }
            ));
            ?>
            <a href="<?php echo esc_url(home_url('/membership')); ?>" class="mt-4 bg-primary text-white px-6 py-3 rounded-lg font-bold text-center hover:bg-primary/90 transition-all">
                Join Us
            </a>
        </nav>
    </div>
</header>