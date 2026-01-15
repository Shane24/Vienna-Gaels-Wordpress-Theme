<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[1000px] mx-auto px-6">
        <?php if (have_posts()) : while (have_posts()) : the_post();
            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_time = get_post_meta(get_the_ID(), '_event_time', true);
            $event_location = get_post_meta(get_the_ID(), '_event_location', true);
            $event_type = get_post_meta(get_the_ID(), '_event_type', true);
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
                        <?php echo esc_html($event_type); ?>
                    </span>
                    <span class="text-2xl font-black text-slate-400">
                        <?php echo date('M d, Y', strtotime($event_date)); ?>
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
                            <p class="font-bold"><?php echo date('l, F j', strtotime($event_date)); ?></p>
                            <p class="text-sm text-slate-600"><?php echo date('g:i A', strtotime($event_time)); ?></p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="size-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-500 uppercase mb-1">Location</h3>
                            <p class="font-bold"><?php echo esc_html($event_location); ?></p>
                            <a href="https://maps.google.com/?q=<?php echo urlencode($event_location); ?>" target="_blank" class="text-sm text-primary hover:underline">View on Map</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="size-12 bg-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-primary">sports</span>
                        </div>
                        <div>
                            <h3 class="font-bold text-sm text-slate-500 uppercase mb-1">Type</h3>
                            <p class="font-bold capitalize"><?php echo esc_html($event_type); ?></p>
                        </div>
                    </div>
                </div>

                <!-- RSVP Button -->
                <button class="w-full md:w-auto bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:scale-105 transition-transform">
                    Register for This Event
                </button>
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