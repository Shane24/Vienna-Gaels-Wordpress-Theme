<?php get_header(); ?>

<main class="w-full">
<!-- Hero Section -->
<section class="relative overflow-hidden pt-10 pb-20 px-6">
    <div class="max-w-[1200px] mx-auto">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 z-10">
                <span class="inline-block px-4 py-1.5 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-widest mb-6">Established 2004</span>
                <h1 class="text-5xl lg:text-7xl font-black leading-[1.05] tracking-tight mb-8">
                    <?php 
                    $headline = get_theme_mod('hero_headline', 'Experience the Heart of Ireland <span class="text-primary italic">in Vienna.</span>');
                    echo wp_kses_post($headline);
                    ?>
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-400 max-w-lg mb-10 leading-relaxed">
                    <?php 
                    echo esc_html(get_theme_mod('hero_description', "Join Austria's premier Gaelic Games club. Whether you're a seasoned player or a complete beginner, there's a place for you in our community."));
                    ?>
                </p>
                <div class="flex flex-wrap gap-4">
                    <?php
                    $primary_text = get_theme_mod('hero_button_primary_text', 'Start Your Journey');
                    $primary_url = get_theme_mod('hero_button_primary_url', '/membership');
                    $secondary_text = get_theme_mod('hero_button_secondary_text', 'View Teams');
                    $secondary_url = get_theme_mod('hero_button_secondary_url', '#teams');
                    
                    // Handle relative URLs
                    if (strpos($primary_url, 'http') !== 0 && strpos($primary_url, '#') !== 0) {
                        $primary_url = home_url($primary_url);
                    }
                    if (strpos($secondary_url, 'http') !== 0 && strpos($secondary_url, '#') !== 0) {
                        $secondary_url = home_url($secondary_url);
                    }
                    ?>
                    <a href="<?php echo esc_url($primary_url); ?>" class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform inline-block">
                        <?php echo esc_html($primary_text); ?>
                    </a>
                    <a href="<?php echo esc_url($secondary_url); ?>" class="border-2 border-primary text-primary px-8 py-4 rounded-xl font-bold text-lg hover:bg-primary/5 transition-colors inline-block">
                        <?php echo esc_html($secondary_text); ?>
                    </a>
                </div>
            </div>
            <div class="lg:col-span-6 relative">
                <?php 
                $hero_image = get_theme_mod('hero_image');
                if ($hero_image) : ?>
                    <div class="relative rounded-2xl overflow-hidden soft-lift rotate-2 hover:rotate-0 transition-transform duration-500">
                        <div class="aspect-[4/5] bg-cover bg-center" style="background-image: url('<?php echo esc_url($hero_image); ?>');"></div>
                    </div>
                <?php endif; ?>
                <div class="absolute -bottom-6 -left-6 bg-vienna-gold text-white p-6 rounded-2xl soft-lift -rotate-3 z-20 hidden md:block">
                    <p class="text-3xl font-black">20+</p>
                    <p class="text-xs font-bold uppercase tracking-tighter">Nationalities Represented</p>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute top-0 right-0 w-1/3 h-full bg-primary/5 -z-10 skew-x-12 translate-x-1/2"></div>
</section>

<!-- Upcoming Events -->
<section class="py-20 bg-background-light dark:bg-background-dark celtic-pattern">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold mb-2">Upcoming Events</h2>
                <div class="w-12 h-1 bg-primary"></div>
            </div>
            <a class="text-primary font-bold text-sm flex items-center gap-2 hover:underline" href="<?php echo get_post_type_archive_link('events'); ?>">
                View All Fixtures <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>
        <div class="flex overflow-x-auto gap-6 pb-8 snap-x no-scrollbar">
            <?php
            $events = new WP_Query(array(
                'post_type' => 'events',
                'posts_per_page' => 3,
                'meta_key' => '_event_start_date',
                'orderby' => 'meta_value',
                'order' => 'ASC'
            ));
            
            if ($events->have_posts()) :
                while ($events->have_posts()) : $events->the_post();
                    $event_data = vienna_gaels_format_event_datetime(get_the_ID());
                    $location = get_post_meta(get_the_ID(), '_event_location', true);
                    
                    // Get event type from taxonomy
                    $event_types = get_the_terms(get_the_ID(), 'event_type');
                    $type_name = $event_types && !is_wp_error($event_types) ? $event_types[0]->name : 'Event';
                    $type_slug = $event_types && !is_wp_error($event_types) ? $event_types[0]->slug : 'event';
                    
                    // Determine styling based on type slug (tournament gets gold, others get green)
                    $is_tournament = (strpos(strtolower($type_slug), 'tournament') !== false);
                    $border_color = $is_tournament ? 'border-vienna-gold' : 'border-primary';
                    $badge_color = $is_tournament ? 'bg-vienna-gold/10 text-vienna-gold' : 'bg-primary/10 text-primary';
            ?>
            <a href="<?php the_permalink(); ?>" class="min-w-[300px] bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift snap-center border-l-4 <?php echo $border_color; ?> hover:-translate-y-2 transition-all duration-300 block group">
                <div class="flex justify-between items-start mb-4">
                    <span class="<?php echo $badge_color; ?> px-3 py-1 rounded-full text-[10px] font-bold uppercase"><?php echo esc_html($type_name); ?></span>
                    <span class="text-xs font-bold text-slate-400"><?php echo $event_data['short_date']; ?></span>
                </div>
                <h3 class="text-xl font-bold mb-1 group-hover:text-primary transition-colors"><?php the_title(); ?></h3>
                <p class="text-slate-500 text-sm mb-4"><?php echo $event_data['date']; ?>, <?php echo $event_data['time']; ?></p>
                <div class="flex items-center gap-2 text-primary font-semibold text-xs">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    <span><?php echo esc_html($location); ?></span>
                </div>
            </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-slate-500">No upcoming events at the moment.</p>';
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Team Selector Tiles -->
<section id="teams" class="py-10 bg-neutral-50 dark:bg-neutral-900">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black mb-4">Our Teams</h2>
            <p class="text-slate-500">Pick a code and join the action. No experience needed.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
            <?php
            // Get team pages by slug
            $teams = array(
                array(
                    'slug' => 'mens-football',
                    'title' => "Men's Football",
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDTNCz8jiO1F0ofvBGFRbk4PFKGsFWVnVjnc0pkGAmJYRTZLWyvM7DsaX3KpnuS5MKvfTyo2t-QSeA9_y6XHfC9XOLyXtsMtbET_-Usbf0n-GmK_71nZNckqZBbx_jIPlqZEqRr_uDPXmZp6DftslIj0V8kJYZe4JtGmAUr2iFVBZA9wVInfyO94aJgvJLVfgaYEijHIyR6TN5C3B-XBmek_mDWgJEudReQQGUNhbRW1wBBoRpwjaBsj86agzwegVIS3uQyxUubzA'
                ),
                array(
                    'slug' => 'ladies-football',
                    'title' => "Ladies Football",
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuBJuAhSrKvYd9mcEfsCDIhIb1-L6nvoISp8L6ScTPamggkQEJ8uyxFK9AzfLLhSlM9fMYKlVMJUs2I_J7fDvWXCHwW3wa4G9R0JKiSF2cS0jsq4Ox5lDoEcuXTbrzgsCfruAYxLaJiKP67cVz5u9bijWJZlD7uzBvAm1cT17Ay-erALok6_rFWGtttIe7nrcmOSNsxBbxr75342jBgUTBaUDp8plzT2HdvaSuff3ARUg9AktxOQqxK9PRm3iv9ufp8CondQ1Gs3zw'
                ),
                array(
                    'slug' => 'hurling',
                    'title' => "Hurling",
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuDMN2Y0nTFvIGgRSzVASKI8CVtpsNxzgEZmCo9S7w1occRn5HwdssEzPP-4ixfwLTjuAVruU2Yw8PrKfXN100ivc7Ziyf2tl96RurAK5Ooaz_GDdJhXZufvoVqsL71EWAVy33jovZsQGDXnLJ44pRR3tVqS4cJcjxQrlchdCKZd7dYfThHLj8kSGvarb9HMoccv4U6HxF1ZyVWsbBgvhsiJckgM2o4NrY-Oc6seQtyBDD5-KJudg9vGn1JJccwVHkbtm_bXWFRHcg'
                ),
                array(
                    'slug' => 'camogie',
                    'title' => "Camogie",
                    'image' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCinqxa1ROPb8zLgUzPyiiIh_8yKoCNs481Nuc1fmuJsInZJSf79hYVvYv5UX9jv0uAIwecMRtyG3p3tJsi4CMNi7hS6K4uCu-E0t4xXiLn1nO1uPQI3gwQitnILiLq9NOaumGSG2sxL4_uudrtt8kPttsjyYLTyDvBA12nROV-pglE1wC0-JL1hnaNQveqnKksT1Ogd_tNpN5fydQub73TtROgY0O3SUMsJSWn2Mc-rZD-72yxfWrZ-vPAYi1E5d9Z85snplGF9w'
                ),
                array(
                    'slug' => 'handball',
                    'title' => "Handball",
                    'image' => 'https://images.unsplash.com/photo-1589487391730-58f20eb2c308?w=800&h=1200&fit=crop'
                )
            );

            foreach ($teams as $team) :
                $page = get_page_by_path($team['slug']);
                
                // Use custom image or featured image if page exists
                if ($page) {
                    $page_url = get_permalink($page->ID);
                    $featured_img = get_the_post_thumbnail_url($page->ID, 'large');
                    $img_url = $featured_img ? $featured_img : $team['image'];
                } else {
                    // If page doesn't exist, create a placeholder link
                    $page_url = home_url('/' . $team['slug']);
                    $img_url = $team['image'];
                }
            ?>
            <a href="<?php echo esc_url($page_url); ?>" class="group relative overflow-hidden rounded-2xl bg-white dark:bg-neutral-800 soft-lift hover:-translate-y-2 transition-all duration-300 block">
                <div class="aspect-[3/4] bg-cover bg-center grayscale md:group-hover:grayscale-0 transition-all duration-500" style="background-image: url('<?php echo esc_url($img_url); ?>');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6">
                    <h3 class="text-white text-xl font-bold mb-2"><?php echo esc_html($team['title']); ?></h3>
                    <span class="text-primary text-sm font-bold md:opacity-0 md:group-hover:opacity-100 transition-opacity">
                        Learn More →
                    </span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

    <!-- Latest News -->
    <section class="py-20 bg-background-light dark:bg-background-dark">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="flex justify-between items-end mb-12">
                <h2 class="text-3xl font-bold">Latest Club News</h2>
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="text-sm font-bold border-b-2 border-primary pb-1">All Articles</a>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <?php
                $news = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3
                ));
                
                if ($news->have_posts()) :
                    while ($news->have_posts()) : $news->the_post();
                ?>
                <article class="group">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="rounded-xl overflow-hidden mb-5 aspect-video bg-neutral-200">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
                    </div>
                    <?php endif; ?>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-[10px] font-bold text-primary uppercase bg-primary/10 px-2 py-0.5 rounded"><?php echo get_the_category()[0]->name; ?></span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase"><?php echo get_the_date('M d, Y'); ?></span>
                    </div>
                    <h3 class="text-xl font-bold mb-3 group-hover:text-primary transition-colors">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>