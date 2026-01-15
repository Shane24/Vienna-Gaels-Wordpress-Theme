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
            <button class="event-filter px-6 py-3 rounded-full font-bold bg-slate-100 dark:bg-neutral-800 hover:bg-primary hover:text-white transition-colors" data-filter="training">
                Training
            </button>
            <button class="event-filter px-6 py-3 rounded-full font-bold bg-slate-100 dark:bg-neutral-800 hover:bg-primary hover:text-white transition-colors" data-filter="match">
                Matches
            </button>
            <button class="event-filter px-6 py-3 rounded-full font-bold bg-slate-100 dark:bg-neutral-800 hover:bg-primary hover:text-white transition-colors" data-filter="social">
                Social
            </button>
        </div>

        <!-- Events Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                    $event_time = get_post_meta(get_the_ID(), '_event_time', true);
                    $event_location = get_post_meta(get_the_ID(), '_event_location', true);
                    $event_type = get_post_meta(get_the_ID(), '_event_type', true);
                    
                    $border_color = $event_type === 'match' ? 'border-vienna-gold' : 'border-primary';
                    $badge_color = $event_type === 'match' ? 'bg-vienna-gold/10 text-vienna-gold' : 'bg-primary/10 text-primary';
            ?>
            <div class="event-card bg-white dark:bg-neutral-800 rounded-2xl p-6 soft-lift border-l-4 <?php echo $border_color; ?> hover:-translate-y-2 transition-all duration-300" data-type="<?php echo $event_type; ?>">
                <div class="flex justify-between items-start mb-4">
                    <span class="<?php echo $badge_color; ?> px-3 py-1 rounded-full text-[10px] font-bold uppercase"><?php echo esc_html($event_type); ?></span>
                    <span class="text-xs font-bold text-slate-400"><?php echo date('M d', strtotime($event_date)); ?></span>
                </div>
                <h3 class="text-xl font-bold mb-1">
                    <a href="<?php the_permalink(); ?>" class="hover:text-primary"><?php the_title(); ?></a>
                </h3>
                <p class="text-slate-500 text-sm mb-4"><?php echo date('l, H:i', strtotime($event_date . ' ' . $event_time)); ?></p>
                <div class="flex items-center gap-2 text-primary font-semibold text-xs mb-4">
                    <span class="material-symbols-outlined text-sm">location_on</span>
                    <span><?php echo esc_html($event_location); ?></span>
                </div>
                <a href="<?php the_permalink(); ?>" class="text-primary font-bold text-sm hover:underline">View Details →</a>
            </div>
            <?php
                endwhile;
            else :
                echo '<p class="text-center col-span-full text-slate-500">No events found.</p>';
            endif;
            ?>
        </div>

        <!-- Pagination -->
        <?php if (paginate_links()) : ?>
        <div class="mt-12 flex justify-center">
            <?php
            echo paginate_links(array(
                'prev_text' => '<span class="material-symbols-outlined">arrow_back</span>',
                'next_text' => '<span class="material-symbols-outlined">arrow_forward</span>',
            ));
            ?>
        </div>
        <?php endif; ?>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
                if (filter === 'all' || card.dataset.type === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php get_footer(); ?>