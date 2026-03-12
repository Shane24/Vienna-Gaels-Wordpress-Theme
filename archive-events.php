<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[1200px] mx-auto px-6">
        <div class="text-center mb-16">
            <h1 class="text-5xl font-black mb-4">All Events</h1>
            <p class="text-xl text-slate-600 dark:text-slate-400">Stay up to date with our training, matches, and social gatherings</p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-4 justify-center mb-12">
            <button class="event-filter active px-6 py-3 rounded-full font-bold bg-primary text-white" data-filter="all">
                All Events
            </button>
            <?php
            $event_types = get_terms(array(
                'taxonomy' => 'event_type',
                'hide_empty' => false,
            ));
            
            if ($event_types && !is_wp_error($event_types)) :
                foreach ($event_types as $event_type) :
            ?>
            <button class="event-filter px-6 py-3 rounded-full font-bold bg-slate-100 dark:bg-neutral-800 hover:bg-primary hover:text-white transition-colors" data-filter="<?php echo esc_attr($event_type->slug); ?>">
                <?php echo esc_html($event_type->name); ?>
            </button>
            <?php
                endforeach;
            endif;
            ?>
        </div>

        <?php
        $today = date('Y-m-d');

        $shared_args = array(
            'post_type'      => 'events',
            'posts_per_page' => -1,
            'meta_key'       => '_event_start_date',
            'orderby'        => 'meta_value',
        );

        $upcoming_query = new WP_Query(array_merge($shared_args, array(
            'order'      => 'ASC',
            'meta_query' => array(
                array(
                    'key'     => '_event_start_date',
                    'value'   => $today,
                    'compare' => '>=',
                    'type'    => 'DATE',
                ),
            ),
        )));

        $past_query = new WP_Query(array_merge($shared_args, array(
            'order'      => 'DESC',
            'meta_query' => array(
                array(
                    'key'     => '_event_start_date',
                    'value'   => $today,
                    'compare' => '<',
                    'type'    => 'DATE',
                ),
            ),
        )));

        function render_event_cards($query, $muted = false) {
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $event_data = vienna_gaels_format_event_datetime(get_the_ID());
                    $location   = get_post_meta(get_the_ID(), '_event_location', true);

                    $event_types = get_the_terms(get_the_ID(), 'event_type');
                    $type_name   = $event_types && !is_wp_error($event_types) ? $event_types[0]->name : 'Event';
                    $type_slug   = $event_types && !is_wp_error($event_types) ? $event_types[0]->slug : 'event';

                    $is_tournament = (strpos(strtolower($type_slug), 'tournament') !== false);

                    if ($muted) {
                        $border_color = 'border-slate-300 dark:border-slate-600';
                        $badge_color  = 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400';
                        $location_color = 'text-slate-400';
                    } else {
                        $border_color   = $is_tournament ? 'border-vienna-gold' : 'border-primary';
                        $badge_color    = $is_tournament ? 'bg-vienna-gold/10 text-vienna-gold' : 'bg-primary/10 text-primary';
                        $location_color = 'text-primary';
                    }
            ?>
            <div class="event-card <?php echo $muted ? 'opacity-60 hover:opacity-100' : ''; ?> bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift border-l-4 <?php echo $border_color; ?> hover:-translate-y-2 transition-all duration-300" data-type="<?php echo esc_attr($type_slug); ?>">
                <div class="flex justify-between items-start mb-4">
                    <span class="<?php echo $badge_color; ?> px-3 py-1 rounded-full text-[10px] font-bold uppercase"><?php echo esc_html($type_name); ?></span>
                    <span class="text-xs font-bold text-slate-400"><?php echo $event_data['short_date']; ?></span>
                </div>
                <h3 class="text-xl font-bold mb-1">
                    <a href="<?php the_permalink(); ?>" class="hover:text-primary"><?php the_title(); ?></a>
                </h3>
                <p class="text-slate-500 text-sm mb-4"><?php echo $event_data['date']; ?>, <?php echo $event_data['time']; ?></p>
                <div class="flex items-center gap-2 <?php echo $location_color; ?> font-semibold text-xs mb-4">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    <span><?php echo esc_html($location); ?></span>
                </div>
                <a href="<?php the_permalink(); ?>" class="text-primary font-bold text-sm hover:underline">View Details →</a>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center col-span-full text-slate-500 py-8">No upcoming events at the moment.</p>';
            endif;
        }
        ?>

        <!-- Upcoming Events -->
        <div class="mb-16">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-2xl font-bold">Upcoming Events</h2>
                <div class="flex-1 h-px bg-slate-200 dark:bg-slate-700"></div>
                <span class="text-sm font-bold text-primary bg-primary/10 px-3 py-1 rounded-full">
                    <?php echo $upcoming_query->found_posts; ?> events
                </span>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php render_event_cards($upcoming_query, false); ?>
            </div>
        </div>

        <!-- Past Events -->
        <?php if ($past_query->found_posts > 0) : ?>
        <div>
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-2xl font-bold text-slate-500">Past Events</h2>
                <div class="flex-1 h-px bg-slate-200 dark:bg-slate-700"></div>
                <button id="toggle-past" class="text-sm font-bold text-slate-500 hover:text-primary flex items-center gap-1 transition-colors">
                    <span id="toggle-label">Show</span>
                    <span class="material-symbols-outlined text-base" id="toggle-icon">expand_more</span>
                </button>
            </div>
            <div id="past-grid" class="hidden">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php render_event_cards($past_query, true); ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Filter buttons
    const filterBtns = document.querySelectorAll('.event-filter');
    const eventCards = document.querySelectorAll('.event-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-primary', 'text-white');
                b.classList.add('bg-slate-100', 'dark:bg-neutral-800');
            });
            this.classList.add('active', 'bg-primary', 'text-white');
            this.classList.remove('bg-slate-100', 'dark:bg-neutral-800');

            eventCards.forEach(card => {
                card.style.display = (filter === 'all' || card.dataset.type === filter) ? 'block' : 'none';
            });
        });
    });

    // Toggle past events
    const toggleBtn   = document.getElementById('toggle-past');
    const pastGrid    = document.getElementById('past-grid');
    const toggleLabel = document.getElementById('toggle-label');
    const toggleIcon  = document.getElementById('toggle-icon');

    if (toggleBtn && pastGrid) {
        toggleBtn.addEventListener('click', function() {
            const isHidden = pastGrid.classList.contains('hidden');
            pastGrid.classList.toggle('hidden', !isHidden);
            toggleLabel.textContent = isHidden ? 'Hide' : 'Show';
            toggleIcon.textContent  = isHidden ? 'expand_less' : 'expand_more';
        });
    }
});
</script>

<?php get_footer(); ?>
