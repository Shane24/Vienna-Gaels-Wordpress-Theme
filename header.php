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
                    <div>
                        <h1 class="text-base sm:text-lg font-black tracking-tight leading-none"><?php bloginfo('name'); ?></h1>
                        <p class="text-[9px] font-bold text-primary tracking-[0.15em] uppercase"><?php bloginfo('description'); ?></p>
                    </div>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3">
                    <div class="size-12 bg-primary rounded-lg flex items-center justify-center text-white flex-shrink-0">
                        <span class="material-symbols-outlined text-2xl">sports_rugby</span>
                    </div>
                    <div>
                        <h1 class="text-base sm:text-lg font-black tracking-tight leading-none"><?php bloginfo('name'); ?></h1>
                        <p class="text-[9px] font-bold text-primary tracking-[0.15em] uppercase"><?php bloginfo('description'); ?></p>
                    </div>
                </a>
            <?php endif; ?>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden lg:flex items-center gap-4 xl:gap-8">
            <?php
            class Vienna_Gaels_Desktop_Walker extends Walker_Nav_Menu {
                function start_lvl(&$output, $depth = 0, $args = null) {
                    $output .= '<div class="absolute left-0 top-full mt-2 w-56 bg-white dark:bg-neutral-800 rounded-xl shadow-xl border border-primary/10 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 py-2 z-50">';
                }
                
                function end_lvl(&$output, $depth = 0, $args = null) {
                    $output .= '</div>';
                }
                
                function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                    $classes = empty($item->classes) ? array() : (array) $item->classes;
                    $has_children = in_array('menu-item-has-children', $classes);
                    
                    if ($depth === 0) {
                        $wrapper_class = $has_children ? 'relative group' : '';
                        if ($wrapper_class) {
                            $output .= '<div class="' . $wrapper_class . '">';
                        }
                        
                        $output .= '<a href="' . esc_url($item->url) . '" class="text-sm font-semibold hover:text-primary transition-colors whitespace-nowrap flex items-center gap-1">';
                        $output .= esc_html($item->title);
                        
                        if ($has_children) {
                            $output .= '<span class="material-symbols-outlined text-base">expand_more</span>';
                        }
                        
                        $output .= '</a>';
                    } else {
                        $output .= '<a href="' . esc_url($item->url) . '" class="block px-4 py-2 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-colors">';
                        $output .= esc_html($item->title);
                        $output .= '</a>';
                    }
                }
                
                function end_el(&$output, $item, $depth = 0, $args = null) {
                    $classes = empty($item->classes) ? array() : (array) $item->classes;
                    $has_children = in_array('menu-item-has-children', $classes);
                    
                    if ($depth === 0 && $has_children) {
                        $output .= '</div>';
                    }
                }
            }
            
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => '',
                'fallback_cb' => '__return_false',
                'items_wrap' => '%3$s',
                'depth' => 2,
                'walker' => new Vienna_Gaels_Desktop_Walker()
            ));
            ?>
        </nav>

        <!-- CTA + Mobile Menu Button -->
        <div class="flex items-center gap-2">
            <?php if (get_theme_mod('header_button_show', true)) : 
                $header_btn_text = get_theme_mod('header_button_text', 'Join Us');
                $header_btn_url = get_theme_mod('header_button_url', '/membership');
                
                // Handle relative URLs
                if (strpos($header_btn_url, 'http') !== 0 && strpos($header_btn_url, '#') !== 0) {
                    $header_btn_url = home_url($header_btn_url);
                }
            ?>
                <a href="<?php echo esc_url($header_btn_url); ?>" class="hidden xl:block bg-primary text-white px-5 py-2.5 rounded-lg font-bold text-sm tracking-wide hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 whitespace-nowrap">
                    <?php echo esc_html($header_btn_text); ?>
                </a>
            <?php endif; ?>
            <button id="mobile-menu-toggle" class="lg:hidden text-primary p-2 hover:bg-primary/10 rounded-lg transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden border-t border-primary/10 bg-white dark:bg-neutral-900">
        <nav class="max-w-[1400px] mx-auto px-6 py-6">
            <?php
            class Vienna_Gaels_Mobile_Walker extends Walker_Nav_Menu {
                function start_lvl(&$output, $depth = 0, $args = null) {
                    $output .= '<div class="submenu-items hidden pl-4 mt-2 space-y-2 border-l-2 border-primary/20">';
                }
                
                function end_lvl(&$output, $depth = 0, $args = null) {
                    $output .= '</div>';
                }
                
                function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                    $classes = empty($item->classes) ? array() : (array) $item->classes;
                    $has_children = in_array('menu-item-has-children', $classes);
                    
                    if ($depth === 0) {
                        $output .= '<div class="mobile-menu-item">';
                        if ($has_children) {
                            $output .= '<div class="flex items-center justify-between">';
                            $output .= '<a href="' . esc_url($item->url) . '" class="text-base font-semibold hover:text-primary transition-colors py-3 block flex-1">';
                            $output .= esc_html($item->title);
                            $output .= '</a>';
                            $output .= '<button class="submenu-toggle p-3 text-primary hover:bg-primary/10 rounded-lg transition-colors" aria-label="Toggle submenu">';
                            $output .= '<span class="material-symbols-outlined text-xl">expand_more</span>';
                            $output .= '</button>';
                            $output .= '</div>';
                        } else {
                            $output .= '<a href="' . esc_url($item->url) . '" class="text-base font-semibold hover:text-primary transition-colors py-3 block">';
                            $output .= esc_html($item->title);
                            $output .= '</a>';
                        }
                    } else {
                        $output .= '<a href="' . esc_url($item->url) . '" class="text-sm font-medium hover:text-primary transition-colors py-2.5 block">';
                        $output .= esc_html($item->title);
                        $output .= '</a>';
                    }
                }
                
                function end_el(&$output, $item, $depth = 0, $args = null) {
                    if ($depth === 0) {
                        $output .= '</div>';
                    }
                }
            }
            
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'flex flex-col gap-1',
                'fallback_cb' => '__return_false',
                'items_wrap' => '<div class="%2$s">%3$s</div>',
                'depth' => 2,
                'walker' => new Vienna_Gaels_Mobile_Walker()
            ));
            ?>
        </nav>
    </div>
</header>