<?php get_header(); ?>

<main class="w-full py-20">
    <div class="max-w-[800px] mx-auto px-6">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <article class="mb-12">
            <!-- Breadcrumb -->
            <div class="mb-8 text-sm text-slate-500">
                <a href="<?php echo home_url('/'); ?>" class="hover:text-primary">Home</a> / 
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="hover:text-primary">News</a> / 
                <span class="text-slate-700 dark:text-slate-300"><?php the_title(); ?></span>
            </div>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
            <div class="rounded-2xl overflow-hidden mb-8 aspect-video">
                <?php the_post_thumbnail('large', array('class' => 'w-full h-full object-cover')); ?>
            </div>
            <?php endif; ?>

            <!-- Meta Info -->
            <div class="flex items-center gap-4 mb-6">
                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase">
                    <?php echo get_the_category()[0]->name; ?>
                </span>
                <span class="text-sm text-slate-500">
                    <?php echo get_the_date('F j, Y'); ?>
                </span>
                <span class="text-sm text-slate-500">
                    By <?php the_author(); ?>
                </span>
            </div>

            <!-- Title -->
            <h1 class="text-4xl md:text-5xl font-black mb-8 leading-tight">
                <?php the_title(); ?>
            </h1>

            <!-- Content -->
            <div class="prose prose-lg max-w-none dark:prose-invert prose-headings:font-bold prose-a:text-primary prose-img:rounded-xl">
                <?php the_content(); ?>
            </div>

            <!-- Tags -->
            <?php if (has_tag()) : ?>
            <div class="mt-10 pt-10 border-t border-slate-200 dark:border-slate-700">
                <h3 class="text-sm font-bold text-slate-500 uppercase mb-4">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    <?php
                    $tags = get_the_tags();
                    foreach ($tags as $tag) {
                        echo '<a href="' . get_tag_link($tag->term_id) . '" class="px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full text-sm hover:bg-primary hover:text-white transition-colors">' . $tag->name . '</a>';
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Share Buttons -->
            <div class="mt-10 pt-10 border-t border-slate-200 dark:border-slate-700">
                <h3 class="text-sm font-bold text-slate-500 uppercase mb-4">Share This Article</h3>
                <div class="flex gap-3">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="size-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-sm">share</span>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" target="_blank" class="size-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-sm">chat</span>
                    </a>
                    <button onclick="navigator.clipboard.writeText('<?php the_permalink(); ?>')" class="size-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center hover:bg-primary hover:text-white transition-colors">
                        <span class="material-symbols-outlined text-sm">link</span>
                    </button>
                </div>
            </div>
        </article>

        <!-- Related Posts -->
        <?php
        $related = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post__not_in' => array(get_the_ID()),
            'category__in' => wp_get_post_categories(get_the_ID())
        ));
        
        if ($related->have_posts()) :
        ?>
        <div class="mt-20 pt-20 border-t border-slate-200 dark:border-slate-700">
            <h2 class="text-3xl font-bold mb-10">Related Articles</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <?php while ($related->have_posts()) : $related->the_post(); ?>
                <article class="group">
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="rounded-xl overflow-hidden mb-4 aspect-video bg-neutral-200">
                        <div class="w-full h-full bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');"></div>
                    </div>
                    <?php endif; ?>
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary transition-colors">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h3>
                    <p class="text-sm text-slate-500"><?php echo get_the_date('M d, Y'); ?></p>
                </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
        <?php endif; ?>

        <?php endwhile; endif; ?>
    </div>
</main>

<?php get_footer(); ?>