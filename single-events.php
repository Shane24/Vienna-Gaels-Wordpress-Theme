<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[1000px] mx-auto px-6">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            $start_date = get_post_meta(get_the_ID(), '_event_start_date', true);
            $end_date = get_post_meta(get_the_ID(), '_event_end_date', true);
            $start_time = get_post_meta(get_the_ID(), '_event_start_time', true);
            $end_time = get_post_meta(get_the_ID(), '_event_end_time', true);
            $location = get_post_meta(get_the_ID(), '_event_location', true);
            
            // Get event type from taxonomy
            $event_types = get_the_terms(get_the_ID(), 'event_type');
            $type_name = $event_types && !is_wp_error($event_types) ? $event_types[0]->name : 'Event';
            
            // Format date display
            if ($end_date && $end_date !== $start_date) {
                $date_display = date('M d', strtotime($start_date)) . ' - ' . date('M d, Y', strtotime($end_date));
            } else {
                $date_display = date('M d, Y', strtotime($start_date));
            }
            
            // Format time display
            if ($end_time) {
                $time_display = date('g:i A', strtotime($start_time)) . ' - ' . date('g:i A', strtotime($end_time));
            } else {
                $time_display = date('g:i A', strtotime($start_time));
            }
        ?>
        
        <article>
            <!-- Back Button -->
            <div class="mb-8">
                <a href="<?php echo get_post_type_archive_link('events'); ?>" class="inline-flex items-center gap-2 text-primary font-bold hover:underline">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Back to Events
                </a>
            </div>

            <!-- Event Header -->
            <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 md:p-12 soft-lift mb-10">
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <span class="bg-primary/10 text-primary px-4 py-2 rounded-full text-xs font-bold uppercase">
                        <?php echo esc_html($type_name); ?>
                    </span>
                    <span class="text-2xl font-black text-slate-400">
                        <?php echo $date_display; ?>
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black mb-8 leading-tight">
                    <?php the_title(); ?>
                </h1>

                <!-- Event Details Grid -->
                <div class="grid md:grid-cols-3 gap-6 mb-8">
                    <div class="flex items-start gap-4">
                        <div class="size-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary">calendar_month</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-500 uppercase mb-1">Date & Time</h3>
                            <p class="font-bold"><?php echo date('l, F j', strtotime($start_date)); ?></p>
                            <?php if ($end_date && $end_date !== $start_date) : ?>
                                <p class="text-sm text-slate-600">to <?php echo date('l, F j', strtotime($end_date)); ?></p>
                            <?php endif; ?>
                            <p class="text-sm text-slate-600 mt-1"><?php echo $time_display; ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="size-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-500 uppercase mb-1">Location</h3>
                            <p class="font-bold"><?php echo esc_html($location); ?></p>
                            <a href="https://maps.google.com/?q=<?php echo urlencode($location); ?>" target="_blank" class="text-sm text-primary hover:underline">View on Map</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="size-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary">sports</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-500 uppercase mb-1">Type</h3>
                            <p class="font-bold"><?php echo esc_html($type_name); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Registration Button - Spond Integration -->
                
                <!-- OPTION A: Direct link to Spond event (if you have event URLs) -->
                <?php 
                // Get custom Spond URL field (you'll need to add this in event meta box)
                $spond_url = get_post_meta(get_the_ID(), '_spond_event_url', true);
                
                if ($spond_url) : ?>
                    <a href="<?php echo esc_url($spond_url); ?>" target="_blank" rel="noopener" class="w-full md:w-auto inline-block text-center bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform">
                        View Event on Spond
                    </a>
                <?php else : ?>
                    <!-- OPTION B: General link to Spond group/club -->
                     <a href="https://spond.com/client/groups/0E12FD70802F4054BDDBDE1E450B648CD" target="_blank" class="w-full md:w-auto inline-block text-center bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform">
                        View on Spond
                    </a>
                    
                    <!-- OR OPTION C: Download Spond app prompt -->
                    <!-- Uncomment if you prefer this approach
                    <div class="space-y-4">
                        <p class="text-slate-600 dark:text-slate-400 font-semibold">
                            Register for this event on Spond:
                        </p>
                        <div class="flex flex-wrap gap-4">
                            <a href="https://apps.apple.com/app/spond/id1084783612" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-black text-white px-6 py-3 rounded-xl font-bold hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined">phone_iphone</span>
                                Download on iOS
                            </a>
                            <a href="https://play.google.com/store/apps/details?id=com.spond.spond" target="_blank" rel="noopener" class="inline-flex items-center gap-2 bg-primary text-white px-6 py-3 rounded-xl font-bold hover:scale-105 transition-transform">
                                <span class="material-symbols-outlined">android</span>
                                Download on Android
                            </a>
                        </div>
                        <p class="text-sm text-slate-500">
                            Already have Spond? Search for "Vienna Gaels" to find our group.
                        </p>
                    </div>
                    -->
                <?php endif; ?>
            </div>

            <!-- Event Description -->
            <?php if (get_the_content()) : ?>
            <div class="bg-white dark:bg-neutral-800 rounded-2xl p-8 md:p-12 soft-lift">
                <h2 class="text-2xl font-bold mb-6">Event Details</h2>
                <div class="prose prose-lg max-w-none dark:prose-invert">
                    <?php the_content(); ?>
                </div>
            </div>
            <?php endif; ?>
        </article>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>