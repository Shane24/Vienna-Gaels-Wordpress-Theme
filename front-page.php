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