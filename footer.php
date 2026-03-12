<!-- Footer -->
<footer class="bg-[#1a1a1a] text-white pt-20 pb-10">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-20">
            <div class="col-span-1 md:col-span-1">
                <div class="flex items-center gap-3 mb-6">
                    <h2 class="text-lg font-black tracking-tight"><?php bloginfo('name'); ?></h2>
                </div>
                <p class="text-neutral-400 text-sm leading-relaxed mb-6">
                    Proudly promoting Gaelic Games and Irish culture in the heart of Vienna since 2004.
                </p>
                <?php
                $socials = array(
                    'facebook'  => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.791-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.883v2.27h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z"/></svg>',
                    'instagram' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>',
                    'twitter'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.911-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
                    'youtube'   => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
                );
                $social_links = array_filter(array_map(fn($k) => get_theme_mod($k . '_link'), array_keys($socials)));
                if (!empty($social_links)) : ?>
                <div class="flex gap-4">
                    <?php foreach ($socials as $key => $svg) :
                        $url = get_theme_mod($key . '_link');
                        if ($url) : ?>
                        <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors"
                           href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener noreferrer"
                           aria-label="<?php echo esc_attr(ucfirst($key)); ?>">
                            <?php echo $svg; ?>
                        </a>
                    <?php endif; endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-xs tracking-[0.2em] text-neutral-500">Quick Links</h4>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'container' => 'ul',
                    'menu_class' => 'space-y-4 text-sm text-neutral-300'
                ));
                ?>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase text-xs tracking-[0.2em] text-neutral-500">Contact</h4>
                <ul class="space-y-4 text-sm text-neutral-300">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-sm mt-0.5">mail</span>
                        <span>secretary.vienna.europe@gaa.ie</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-sm mt-0.5">location_on</span>
                        <span>Vienna, Austria</span>
                    </li>
                </ul>
            </div>
            <div>
    <h4 class="font-bold mb-6 uppercase text-xs tracking-[0.2em] text-neutral-500">Our Sponsors</h4>
    <?php
    $sponsors = new WP_Query(array(
        'post_type' => 'sponsors',
        'posts_per_page' => -1,
        'orderby' => 'meta_value_num',
        'meta_key' => '_sponsor_order',
        'order' => 'ASC'
    ));
    
    if ($sponsors->have_posts()) :
    ?>
        <div class="sponsor-grid">
            <?php while ($sponsors->have_posts()) : $sponsors->the_post(); 
                $logo_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $sponsor_url = get_post_meta(get_the_ID(), '_sponsor_url', true);
                $sponsor_name = get_the_title();
                
                if ($logo_url) :
                    $logo_html = '<img src="' . esc_url($logo_url) . '" alt="' . esc_attr($sponsor_name) . '" class="sponsor-logo">';
                    
                    if ($sponsor_url) :
            ?>
                        <a href="<?php echo esc_url($sponsor_url); ?>" 
                           target="_blank" 
                           rel="noopener noreferrer" 
                           class="sponsor-logo-container"
                           title="Visit <?php echo esc_attr($sponsor_name); ?>">
                            <?php echo $logo_html; ?>
                        </a>
            <?php 
                    else :
            ?>
                        <div class="sponsor-logo-container">
                            <?php echo $logo_html; ?>
                        </div>
            <?php
                    endif;
                endif;
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    <?php else : ?>
        <div class="sponsor-grid">
            <div class="sponsor-logo-container"></div>
            <div class="sponsor-logo-container"></div>
            <div class="sponsor-logo-container"></div>
            <div class="sponsor-logo-container"></div>
        </div>
    <?php endif; ?>
</div>
        </div>
        <div class="pt-8 border-t border-neutral-800 text-center">
            <p class="text-neutral-500 text-xs">
                © <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>