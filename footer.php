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
                <div class="flex gap-4">
                    <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">social_leaderboard</span>
                    </a>
                    <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">photo_camera</span>
                    </a>
                    <a class="size-10 bg-neutral-800 rounded-full flex items-center justify-center hover:bg-primary transition-colors" href="#">
                        <span class="material-symbols-outlined text-sm">alternate_email</span>
                    </a>
                </div>
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